<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBrandsRequest;
use App\Http\Requests\CreateCameraRequest;
use App\Http\Requests\CreateCameraTypeRequest;
use App\Http\Requests\CreateLensRequest;
use App\Http\Requests\UpdateCameraRequest;
use App\Http\Requests\UpdateLensRequest;
use App\Models\Brand;
use App\Models\Camera;
use App\Models\CameraType;
use App\Models\Lens;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CameraController extends Controller
{

    // manage camera data
    public function index(Request $request)
    {

        $keyword = $request->keyword;
        $brandFiltering = $request->brand;
        $cameraTypeFiltering = $request->camera_type;


        $brands = Brand::select('id', 'name')->get();
        $cameraTypes = CameraType::with('brands')->select('id', 'name', 'brand_id')->get();
        $cameras = Camera::with(['camera_types', 'camera_types.brands'])
            ->when($brandFiltering, function ($query, $brandFiltering) {
                return $query->whereHas('camera_types.brands', function ($q) use ($brandFiltering) {
                    $q->where('id', $brandFiltering);
                });
            })
            ->when($cameraTypeFiltering, function ($query, $cameraTypeFiltering) {
                return $query->where('camera_type_id', $cameraTypeFiltering);
            })
            ->when($keyword, function ($query, $keyword) {
                return $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('code', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('harga_per_hari', 'LIKE', '%' . $keyword . '%')
                        ->orWhereHas('camera_types', function ($subQuery) use ($keyword) {
                            $subQuery->where('name', 'LIKE', '%' . $keyword . '%');
                        })
                        ->orWhereHas('camera_types.brands', function ($subQuery) use ($keyword) {
                            $subQuery->where('name', 'LIKE', '%' . $keyword . '%');
                        });
                });
            })
            ->paginate(6);


        return view('admin_panel.adminManageCamera', compact('cameras', 'brands', 'cameraTypes', 'keyword'));
    }


    // method untuk tambah data kamera

    public function store_cameras(CreateCameraRequest $request)
    {
        $nameCamera = $request->name;
        $cameraTypeId = $request->camera_type_id;

        // mengambil data nama brand untuk dijadikan nama folder file
        $cameraType = CameraType::with('brands')->findOrFail($cameraTypeId);
        $brandName = $cameraType->brands->name;

        $imageNames = []; // Default image name

        $thumbnail = '';


        // memastikan apakah menerima file image atau tidak
        if ($request->hasFile('image')) {
            $images = $request->file('image');

            foreach ($images as $image) {
                // penamaan file image
                $imageName = $nameCamera . '_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                // penamaan nama folder
                $folderName = 'admin_assets/rental-kamera/camera/' . $brandName . '/' . $nameCamera;
                // menyimpan file ke directory 'nama folder'/ 'nama file'/ di storage public
                $image->storeAs($folderName, $imageName, 'public');
                // memasukkan sejumlah nama file yg dipilih ke dalam JSON array $imageNames[]
                $imageNames[] = $imageName;
            }
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');

            $thumbnailName = $nameCamera . '-thumbnail-' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();

            $thumbnailFolder = 'admin_assets/rental-kamera/camera/' . $brandName . '/' . $nameCamera . '/thumbnail';

            $thumbnail->storeAs($thumbnailFolder, $thumbnailName, 'public');

            $thumbnail = $thumbnailName;
        }

        Camera::create([
            'camera_type_id' => $request->camera_type_id,
            'name' => $nameCamera,
            'code' => $request->code,
            'harga_per_hari' => $request->harga_per_hari,
            'image' => json_encode($imageNames),
            'thumbnail' => $thumbnail,
            'deskripsi' => $request->deskripsi,
        ]);

        Alert::success('Berhasil!', 'Data Kamera telah ditambahkan');
        return redirect('/admin_panel/adminManageCamera');
    }

    // method untuk edit data kamera

    public function update_cameras(UpdateCameraRequest $request, $id)
    {
        $cameras = Camera::findOrFail($id);

        $nameCamera = $request->name;
        $cameraTypeId = $request->camera_type_id;

        // mengambil data nama brand untuk dijadikan nama folder file
        $cameraType = CameraType::with('brands')->findOrFail($cameraTypeId);
        $brandName = $cameraType->brands->name;

        $imageNames = json_decode($cameras->image, true); // Default image name
        $thumbnail = $cameras->thumbnail; // Default thumbnail

        // memastikan apakah menerima file image atau tidak
        if ($request->hasFile('image')) {
            $images = $request->file('image');

            // menghapus foto lama dari storage jika upload foto baru
            // Hapus gambar lama dari penyimpanan
            foreach ($imageNames as $oldImage) {
                $oldImagePath = 'admin_assets/rental-kamera/camera/' . $brandName . '/' . $nameCamera . '/' . $oldImage;
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }
            // membersihkan nama file image sebelumnya jika file image baru diupload
            $imageNames = [];

            foreach ($images as $image) {
                // penamaan file image
                $imageName = $nameCamera . '_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                // penamaan nama folder
                $folderName = 'admin_assets/rental-kamera/camera/' . $brandName . '/' . $nameCamera;
                // menyimpan file ke directory 'nama folder'/ 'nama file'/ di storage public
                $image->storeAs($folderName, $imageName, 'public');
                // memasukkan sejumlah nama file yg dipilih ke dalam JSON array $imageNames[]
                $imageNames[] = $imageName;
            }
        }

        // Memastikan apakah menerima file thumbnail atau tidak
        if ($request->hasFile('thumbnail')) {
            $thumbnailFile = $request->file('thumbnail');

            if ($thumbnailFile->isValid()) {
                // Hapus thumbnail lama dari penyimpanan
                $oldThumbnailPath = 'admin_assets/rental-kamera/camera/' . $brandName . '/' . $nameCamera . '/thumbnail/' . $thumbnail;
                if (Storage::disk('public')->exists($oldThumbnailPath)) {
                    Storage::disk('public')->delete($oldThumbnailPath);
                }

                // Penamaan file thumbnail baru
                $thumbnailName = $nameCamera . '-thumbnail-' . uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();

                // Menyimpan file thumbnail ke directory 'nama folder'/ 'thumbnail'/ di storage public
                $thumbnailFolder = 'admin_assets/rental-kamera/camera/' . $brandName . '/' . $nameCamera . '/thumbnail';
                $thumbnailFile->storeAs($thumbnailFolder, $thumbnailName, 'public');

                $thumbnail = $thumbnailName;
            }
        }


        // Ambil path folder lama dan baru untuk merename jika nama kamera diubah
        $oldFolderPath = 'admin_assets/rental-kamera/camera/' . $brandName . '/' . $cameras->name;
        $newFolderPath = 'admin_assets/rental-kamera/camera/' . $brandName . '/' . $nameCamera;

        // Periksa apakah nama kamera telah berubah, lalu rename folder jika iya
        if ($cameras->name !== $nameCamera) {
            Storage::disk('public')->move($oldFolderPath, $newFolderPath);
        }

        $cameras->update([
            'camera_type_id' => $request->camera_type_id,
            'name' => $nameCamera,
            'code' => $request->code,
            'harga_per_hari' => $request->harga_per_hari,
            'image' => json_encode($imageNames),
            'thumbnail' => $thumbnail,
            'deskripsi' => $request->deskripsi,
        ]);

        Alert::success('Berhasil!', 'Data Kamera telah di Update');
        return redirect('/admin_panel/adminManageCamera');
    }

    // method untuk menghapus data kamera dan data pada storage (folder & file)
    public function destroy_cameras($id)
    {

        $cameras = Camera::findOrFail($id);

        // mengambil informasi tipe kamera dan brand
        $cameraType = $cameras->camera_types;
        $brandName = $cameraType->brands->name;

        // nama folder yang dihapus berdasarkan nama brand/ nama camera name/ nama image
        $folderName = 'admin_assets/rental-kamera/camera/' . $brandName . '/' . $cameras->name;

        // menghapus folder dan file didalamnya
        if (Storage::disk('public')->exists($folderName)) {
            Storage::disk('public')->deleteDirectory($folderName);
        }

        // menghapus data kamera dari database
        if ($cameras->rentals->count() > 0) {
            Alert::error('Oops!', 'Anda tidak dapat menghapus data kamera ini, karena data kamera telah terekam pada Rentals');
            return redirect('/admin_panel/adminManageCamera');
        } else {
            $cameras->delete();

            Alert::success('Berhasil!', 'Data Kamera dan File terkait telah dihapus');
            return redirect('/admin_panel/adminManageCamera');
        }
    }
}

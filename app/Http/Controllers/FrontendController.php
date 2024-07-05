<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Booking;
use App\Models\Brand;
use App\Models\Camera;
use App\Models\CameraType;
use App\Models\Category;
use App\Models\Crew;
use App\Models\Package;
use App\Models\Photo;
use App\Models\Rental;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    // untuk menghindari error undefined variable pada frontendLayouts
    // pengambilan data yang diperlukan pada frontendLayouts
    // dilakukan pada provider yaitu App\Providers\ViewServiceProvider dengan memanggil data yang diperlukan

    // method untuk halaman HOME
    public function home()
    {
        // untuk menampilkan 9 daftar album foto
        $albums = Album::with(['photos', 'category'])->latest()->limit(9)->get();

        // menampilkan saran paket rental camera
        $homeCameraInfo = Camera::with(['camera_types.brands', 'rentals' => function ($query) {
            $query->where('status', '!=', 'active');
        }])
            ->inRandomOrder() // untuk mengambil data secara acak
            ->limit(4)->get();
        return view('frontend.home', compact('albums', 'homeCameraInfo'));
    }

    // METHOD UNTUK HALAMAN ABOUT US
    public function about()
    {
        $crews = Crew::all();
        $infoAlbums = Album::with(['category', 'photos'])->latest()->limit(6)->get();

        return view('frontend.about', compact('crews', 'infoAlbums'));
    }


    // METHOD UNTUK HALAMAN STORIES
    public function stories(Request $request)
    {
        // menggunakan pagination dengan 6 item per halaman (paginating LOAD MORE menggunakan AJAX)
        $albums = Album::with(['photos', 'category'])->paginate(6);

        // jika permintaan adalah AJAX, kembalikan data dalam format JSON
        if ($request->ajax()) {
            return response()->json([
                'albums' => view('frontend.partials.albums', compact('albums'))->render(),
                'next_page_url' => $albums->nextPageUrl(),
            ]);
        }

        return view('frontend.stories', compact('albums'));
    }

    // METHOD UNTUK MENAMPILKAN SEMUA ALBUM KE HALAMAN STORIES
    public function show($id, $title)
    {
        $albums = Album::with(['category', 'photos'])->findOrFail($id);


        return view('frontend.album', compact('albums'));
    }

    // METHOD UNTUK HALAMAN STORIES MENAMPILKAN SEMUA FOTO PADA ALBUM TERTENTU
    // BERDASARKAN DATA ALBUM YANG DIKLIK
    public function show_gallery(Request $request, $id, $name)
    {
        $category = Category::with(['albums.photos'])->findOrFail($id);
        $albums = $category->albums()->paginate(6);

        // jika permintaan adalah AJAX, kembalikan data dalam format JSON
        if ($request->ajax()) {
            return response()->json([
                'albums' => view('frontend.partials.sub-stories-partial', compact('albums'))->render(),
                'next_page_url' => $albums->nextPageUrl(),
            ]);
        }

        return view('frontend.sub-stories', compact('category', 'albums'));
    }


    // METHOD UNTUK MENAMPILKAN DAFTAR KAMERA

    public function camera_info(Request $request)
    {

        $brandFiltering = $request->brand;
        $cameraTypeFiltering = $request->camera_type;
        $statusFiltering = $request->status;

        // mengambil data tipe kamera dan brands untuk filtering
        $cameraTypes = CameraType::with('brands')->select('id', 'name', 'brand_id')->get();
        $brands = Brand::select('id', 'name')->get();

        $cameras = Camera::with(['camera_types.brands', 'rentals' => function ($query) {
            $query->where('status', 'active');
        }])
            ->when($brandFiltering, function ($query, $brandFiltering) {
                return $query->whereHas('camera_types.brands', function ($q) use ($brandFiltering) {
                    $q->where('id', $brandFiltering);
                });
            })->when($cameraTypeFiltering, function ($query, $cameraTypeFiltering) {
                return $query->where('camera_type_id', $cameraTypeFiltering);
            })->when($statusFiltering, function ($query, $statusFiltering) {
                if ($statusFiltering == '!active') {
                    return $query->whereDoesntHave('rentals', function ($q) {
                        $q->where('status', 'active');
                    });
                } else {
                    return $query->whereHas('rentals', function ($q) use ($statusFiltering) {
                        $q->where('status', $statusFiltering);
                    });
                }
            })->orderBy('name', 'asc')->paginate(20);




        return view('frontend.camera-info', compact('cameras', 'cameraTypes', 'brands'));
    }
    // METHOD UNTUK MENAMPILKAN DETAIL DATA KAMERA
    public function camera_detail($id, $name)
    {

        $cameras = Camera::with(['camera_types.brands'])->findOrFail($id);

        return view('frontend.camera-detail', compact('cameras'));
    }

    // METHOD UNTUK MENAMPILKAN DATA PACKAGES PHOTOSHOOT

    public function photoshoot_packages()
    {
        // menampilkan seluruh data photoshoot packages
        $photoPackages = Package::orderBy('name', 'ASC')->get();

        // menampilkan saran paket rental camera
        $cameraPackages = Camera::with(['camera_types.brands', 'rentals' => function ($query) {
            $query->where('status', '!=', 'active');
        }])
            ->inRandomOrder() // untuk mengambil data secara acak
            ->limit(4)->get();

        return view('frontend.photoshoot-packages', compact('photoPackages', 'cameraPackages'));
    }

    // METHOD UNTUK MENAMPILKAN DETAIL DATA PACKAGES PHOTOSHOOT

    public function photoshoot_pcg_detail($id, $name)
    {
        $name = urldecode($name);

        $package = Package::findOrFail($id);

        $infoAlbum = Album::with(['category', 'photos'])->latest()->limit(6)->get();

        return view('frontend.photoshoot-detail', compact('package', 'infoAlbum'));
    }
}

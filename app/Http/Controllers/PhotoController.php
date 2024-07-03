<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhotoRequest;
use App\Models\Album;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PhotoController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name')->get();
        return view('/admin_panel/admin-add-photo', compact('categories'));
    }

    // method untuk upload foto ke gallery


    public function store(CreatePhotoRequest $request)
    {

        $thumbnailPath = '';
        // Simpan album baru
        $album = Album::create([
            'title' => $request->title,
            'kategori_id' => $request->kategori_id,
        ]);

        // menyimpan thumbnail album
        if ($request->hasFile('thumbnail')) {

            $thumbnailName = $album->title . ' - tumbnail.' . $request->file('thumbnail')->getClientOriginalExtension();
            $request->file('thumbnail')->storeAs(
                'admin_assets/gallery/00-thumbnails/' . $album->title,
                $thumbnailName,
                'public'
            );

            // Update album dengan path thumbnail
            $album->thumbnail = $thumbnailName;
            $album->save();
        }

        // Simpan foto-foto yang diunggah
        if ($request->hasFile('name')) {
            foreach ($request->file('name') as $file) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs('/admin_assets/gallery/' . $album->title, $fileName, 'public');
                Photo::create([
                    'name' => $fileName,
                    'album_id' => $album->id,
                ]);
            }
        }

        Alert::success('Berhasil!', 'Album dan Foto dari ' . $album->title . ' telah disimpan. Silahkan Cek Album yang baru saja Anda buat.');

        return redirect('/admin_panel/adminManageGallery');
    }

    // function untuk destroy foto berada di AlbumController karena saat menghapus album juga akan menghapus foto
}
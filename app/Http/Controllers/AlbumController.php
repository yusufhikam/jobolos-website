<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAlbumsRequest;
use App\Models\Album;
use App\Models\Category;
use App\Models\Photo;
use App\Models\User;
use App\Notifications\BookingNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AlbumController extends Controller
{
    public function index(Request $request)
    {

        $keyword = $request->keyword; // untuk mengambil data dari keyword pencarian
        $categoryFiltering = $request->category; // mengambil data dari dropdown Filter berdasarkan kategori

        $albums = Album::with('category')
            ->when($keyword, function ($query, $keyword) {
                // qquery untuk mencari nama album /title dan kategori (relasi/one-to-many [hasMany]) berdasarkan keyword
                return $query->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('category', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%');
                    });
            })
            // query untuk menampilkan data berdasarkan dari dropdown kategori 
            ->when($categoryFiltering, function ($query, $categoryFiltering) {
                return $query->where('kategori_id', $categoryFiltering);
            })
            ->paginate(16);

        $categories = Category::all();
        return view('/admin_panel/adminManageGallery', compact('albums', 'categories', 'categoryFiltering'));
    }

    // method untuk mengambil data relasi kategori untuk ditampilkan pada <select> untuk CREATE data kategori

    public function create(Request $request)
    {
        $category = Category::select('id', 'name')->get();

        return view('/admin_panel/admin-add-album', compact('category'));
    }

    // method untuk proses INSERT DATA KATEGORI
    public function store(CreateAlbumsRequest $request)
    {
        // $thumbnailPath = null;

        // if($request->hasFile('thumbnail')){
        //     $thumbnailPath = $request->file('thumbnail')->storeAs()
        // }

        $albums = Album::create($request->all());


        return redirect('/admin_panel/adminManageGallery');
    }


    // method untuk DELETE DATA ALBUM dan FOTO
    public function destroy($id)
    {

        $album = Album::findOrFail($id);

        $folderName = $album->title;

        // menghapus semua foto (relasi table photos ke table Albums) terkait dari database dan storage
        foreach ($album->photos as $foto) {
            Storage::disk('public')->delete('/admin_assets/gallery/' . $folderName . '/' . $foto->name);
            $foto->delete();
        }

        // menghapus folder album dari storage
        Storage::disk('public')->deleteDirectory('/admin_assets/gallery/' . $folderName);
        // Hapus folder thumbnail dari storage
        Storage::disk('public')->deleteDirectory('admin_assets/gallery/00-thumbnails/' . $folderName);

        // hapus album dari database
        $album->delete();

        Alert::success('Berhasil!', 'Album ' . $album->title . ' telah di Hapus!');

        return redirect('/admin_panel/adminManageGallery');
    }

    // 
    public function show($id, $title)
    {
        $album = Album::with('photos')->findOrFail($id);

        return view('/admin_panel/albums', compact('album'));
    }
}
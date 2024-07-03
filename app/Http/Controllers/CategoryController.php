<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {

        $kategori = Category::paginate(5);

        $title = 'Hapus Kategori!';
        $text = "Apakah Anda yakin ingin menghapus kategori ini ?";
        confirmDelete($title, $text);

        return view('/admin_panel/adminManageCategory', compact('kategori'));
    }

    // method untuk INSERT DATA KATEGORI (useless)

    public function create(Request $request)
    {
        // $kategori->create($request->all());
        return view('/admin_panel/admin-add-category');
    }

    // method untuk INSERT DATA KATEGORI 

    public function store(CategoryCreateRequest $request)
    {
        $kategori = Category::where('name', $request->name)->first();

        if ($kategori) {
            Alert::error('Oops!', 'Kategori ' . $kategori->name . ' sudah ada!');
        } else {
            $kategori = Category::create($request->all());

            Alert::success('Berhasil!', 'Kategori ' . $kategori->name . ' telah ditambahkan');

            return redirect('/admin_panel/adminManageCategory');
        }
    }

    // method untuk mencari data kategori berdasarkan id untuk di edit
    public function edit($id)
    {

        $kategori = Category::findOrFail($id);

        return view('/admin_panel/admin-edit-category', compact('kategori'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $updateKategori = Category::findOrFail($id);

        $updateKategori->update($request->all());

        Alert::success('Berhasil!', 'Kategori Telah di Update');

        return redirect('admin_panel/adminManageCategory');
    }


    // 
    public function delete($id)
    {
        $kategori = Category::findOrFail($id);

        return view('/admin_panel/adminManageCategory', compact('kategori'));
    }

    // method untuk DELETE DATA KATEGORI

    public function destroy($id)
    {
        $deleteCategory = Category::findOrFail($id);

        if ($deleteCategory->albums->count() > 0) {
            Alert::error('Oops!', 'Kategori ini telah digunakan pada Data Album, Anda Tidak Dapat Menghapusnya!');
            return redirect('/admin_panel/adminManageCategory');
        } else {
            $deleteCategory->delete();

            Alert::success('Berhasil!', 'Kategori ' . $deleteCategory->name . ' telah di Hapus!');
            return redirect('/admin_panel/adminManageCategory');
        }
    }
}
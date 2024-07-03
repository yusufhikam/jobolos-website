<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBrandsRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    // manage Brands Data

    // untuk manage brands dijadikan satu disini
    public function brands()
    {
        $brands = Brand::paginate(10);

        return view('admin_panel.adminManageBrands', compact('brands'));
    }

    public function store_brands(CreateBrandsRequest $request)
    {

        $nameBrand = $request->name;

        $brands = Brand::where('name', $nameBrand)->first();

        if ($brands) {
            Alert::error('Oops!', 'Brand "' . $nameBrand . '" sudah ada!');
            return redirect('/admin_panel/adminManageBrands');
        } else {
            $brands = Brand::create($request->all());

            Alert::success('Berhasil !', 'Brand ' . $nameBrand . ' telah ditambahkan');

            return redirect('/admin_panel/adminManageBrands');
        }
    }

    public function update_brands(Request $request, $id)
    {
        $nameBrand = $request->name;

        $brands = Brand::findOrFail($id);

        $checkExistBrand = Brand::where('name', $nameBrand)
            ->where('id', '!=', $id)->exists();

        if ($checkExistBrand) {
            Alert::error('Oops!', 'Brand "' . $nameBrand . '" sudah ada!');
            return redirect('/admin_panel/adminManageBrands');
        } else {
            $brands->update($request->all());

            Alert::success('Berhasil !', 'Nama Brand telah di Update menjadi ' . $nameBrand);
            return redirect('/admin_panel/adminManageBrands');
        }
    }


    public function destroy_brands($id)
    {

        $brands = Brand::findOrFail($id);

        if ($brands->cameraTypes()->count() > 0) {

            Alert::error('Oops!', 'Brand ' . $brands->name . ' tidak dapat dihapus, karena telah terekam pada Camera');
            return redirect('/admin_panel/adminManageBrands');
        } else {

            $brands->delete();

            Alert::success('Berhasil !', 'Brand ' . $brands->name . ' telah dihapus');
            return redirect('/admin_panel/adminManageBrands');
        }
    }
}

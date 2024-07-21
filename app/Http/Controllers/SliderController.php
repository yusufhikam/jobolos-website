<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::paginate(5);

        return view('/admin_panel/contents/content-home', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:2048|image'
        ]);

        $newName = '';

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = 'sliders' . '-' . time() . '.' . $extension;
            // $folder = 'admin_assets/sliders';

            $request->file('image')->storeAs('admin_assets/sliders', $newName, 'public');
        }
        $request['image'] = $newName;

        Slider::create(['image' => $newName]);

        Alert::success('Berhasil!', 'Foto Slider telah disimpan');
        return redirect('/admin_panel/contents/content-home');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        Storage::disk('public')->delete('admin_assets/sliders/' . $slider->image);


        $slider->delete();

        Alert::success('Berhasil!', 'Data Foto Slider telah dihapus');
        return redirect('/admin_panel/contents/content-home');
    }
}
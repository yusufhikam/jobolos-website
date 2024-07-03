<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:25',
            'deskripsi' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'harga' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Paket Photoshoot wajib diisi!',
            'name.max' => 'Penamaan Paket Photoshoot maksimal menggunakan 25 karakter',
            'image.max' => 'Ukuran Foto thumbnail maksimal 2 MB',
            'harga.required' => 'Harga Paket Photoshoot wajib diisi!',
        ];
    }
}
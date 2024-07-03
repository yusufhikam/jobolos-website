<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePhotoRequest extends FormRequest
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
            'name' => 'required',
            'title' => 'required|max:30',
            'kategori_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Silahkan Memilih File Foto yang akan di Upload',
            'title.required' => 'Nama Folder wajib diisi',
            'title.max' => 'Penamaan Folder maksimal menggunakan 30 karakter',
            'kategori_id.required' => 'Silahkan Memilih Kategori Foto',
        ];
    }
}

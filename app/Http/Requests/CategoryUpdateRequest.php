<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'name' => 'required|unique:categories,name',
        ];
    }

    public function messages()
    {
        $nama_kategori = $this->input('name');
        $id = $this->route('id');

        return [
            'name.required' => 'Nama Kategori Wajib diisi!',
            'name.unique' => '<h3 style="color:red;">Oops :(</h3> <br>Nama Kategori ' . ucwords($nama_kategori) . '  sudah ada! <br>Mohon gunakan Nama Kategori lain!'
        ];
    }
}

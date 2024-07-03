<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCameraRequest extends FormRequest
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
        $cameraId = $this->route('id'); // Mengambil ID dari parameter rute

        return [
            'camera_type_id' => 'required',
            'name' => 'required|string|max:30',
            'code' => 'required|unique:cameras,code,' . $cameraId,
            'harga_per_hari' => 'required',
            'deskripsi' => 'nullable|string',
            'image.*' => 'image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'camera_type_id.required' => 'Tipe Kamera wajib di pilih',
            'name.required' => 'Nama Kamera Wajib diisi',
            'name.max' => 'Penamaan Kamera maksimal 30 karakter',
            'code.required' => 'Code Kamera Wajib diisi',
            'code.unique' => 'Code tersebut sudah digunakan, Code Kamera tidak boleh sama',
            'harga_per_hari.required' => 'Harga per Hari Wajib diisi',
            'image.*.image' => 'File yang diupload harus berupa gambar',
            'image.*.mimes' => 'File yang diupload harus berupa jpeg, jpg, atau png',
            'image.*.max' => 'Ukuran File yang diupload maksimal 2MB',
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|email|string',
            'password' => 'required|min:8',
            'alamat' => 'required',
            'no_telp' => 'required|max:15',
            'role_id' => 'required',
            'alamat' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format Email tidak valid',
            'email.unique' => 'Email sudah Terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password Minimal 8 Karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'no_telp.required' => 'Nomor Whatsapp wajib diisi',
            'role_id.required' => 'Mohon Pilih Role',
            'image.image' => 'File harus berupa Gambar',
            'image.mimes' => 'Format Gambar yang diperbolehkan : JPEG, JPG, PNG',
            'image.max' => 'Ukuran Gambar Maksimal 2MB',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadBuktiPembayaranRentalKameraRequest extends FormRequest
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
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ];
    }

    public function messages()
    {
        return [
            'bukti_pembayaran.required' => 'Silahkan pilih foto untuk upload Bukti pembayaran Anda',
            'bukti_pembayaran.image' => 'File yang boleh di Upload hanya file Foto',
            'bukti_pembayaran.mimes' => 'Format file Foto yang dibolehkan hanya JPEG, JPG, PNG',
            'bukti_pembayaran.max' => 'Ukuran file Foto maksimal 1MB',
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadBuktiPembayaranRequest extends FormRequest
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
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }


    public function messages()
    {
        return [
            'bukti_pembayaran.required' => 'Silahkan pilih file untuk upload bukti pembayaran Anda.',
            'bukti_pembayaran.image' => 'File yang boleh di upload hanya file Foto',
            'bukti_pembayaran.mimes' => 'Format file Foto yang dibolehkan hanya "JPG, JPEG, PNG"',
            'bukti_pembayaran.max' => 'Ukuran File Foto maksimal 2MB',
        ];
    }
}

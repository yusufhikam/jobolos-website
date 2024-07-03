<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
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
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'bukti_pembayaran.required' => 'Silahkan Upload Bukti Pembayaran Anda.',
            'bukti_pembayaran.image' => 'File yang dapat di upload hanya file Foto.',
            'bukti_pembayaran.mimes' => 'Format file yang boleh di upload hanya "JPG, JPEG, PNG".',
            'bukti_pembayaran.max' => 'Ukuran File maksimal 2MB.',
        ];
    }
}

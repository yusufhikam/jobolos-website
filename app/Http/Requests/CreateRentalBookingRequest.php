<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRentalBookingRequest extends FormRequest
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
            'camera_id' => 'required',
            'lens_id' => 'required',
            'tgl_sewa' => 'required|date',
            'tgl_kembali' => 'required|date|after_or_equal:tgl_sewa',
            'jaminan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'camera_id.required' => 'Camera harus diisi',
            'lens_id.required' => 'Lensa harus diisi',
            'tgl_sewa.required' => 'Anda harus menentukan tanggal sewa',
            'tgl_sewa.date' => 'Tolong Pilih tanggal Penyewaan',
            'tgl_kembali.required' => 'Anda harus menentukan tanggal pengembalian',
            'tgl_kembali.date' => 'Tolong Pilih tanggal pengembalian',
            'tgl_kembali.after_or_equal' => 'Tanggal pengembalian harus setelah tanggal penyewaan',
            'jaminan.required' => 'Untuk melakukan penyewaan diperlukan Jaminan seperti KTP'
        ];
    }
}
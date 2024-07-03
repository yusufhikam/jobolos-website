<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
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
            'tanggal' => 'required|date',
            'package_id' => 'required',
            'location_type' => 'required|in:rembang,other',
            'location' => 'required',
            'concept' => 'nullable',
            'payment_type' => 'required|in:dp,full',
        ];
    }

    public function messages()
    {
        return [
            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.date' => 'Tanggal harus berupa format tanggal yang valid.',
            'package_id.required' => 'Pilih salah satu paket yang tersedia.',
            'location_type.required' => 'Pilih tipe lokasi event.',
            'location_type.in' => 'Tipe lokasi event harus di antara pilihan lokasi.',
            'location.required' => 'Detail lokasi event harus diisi.',
            'payment_type.required' => 'Pilih tipe pembayaran.',
            'payment_type.in' => 'tipe pembayaran harus di antara pilihan tipe pembayaran.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCameraTypeRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'brand_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Tipe Kamera harus diisi',
            'name.max' => 'Penamaan tipe kamera maksimal 30 karakter',
            'brand_id.required' => 'Brand kamera harus diisi',
        ];
    }
}
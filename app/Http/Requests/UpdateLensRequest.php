<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLensRequest extends FormRequest
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
        $lensId = $this->route('id');
        return [
            'camera_type_id' => 'required',
            'name' => 'required',
            'code' => 'required|unique:lenses,code,' . $lensId,
            'harga_per_hari' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'camera_type_id.required' => 'Wajib memilih Tipe Kamera',
            'name.required' => 'Focal Length Lensa Wajib diisi',
            'code.required' => 'Code Lensa Wajib diisi',
            'code.unique' => 'Kode Lensa sudah digunakan.<br> Kode bersifat Unique, tidak boleh sama',
            'harga_per_hari.required' => 'Harga Sewa per Hari Wajib diisi',
        ];
    }
}
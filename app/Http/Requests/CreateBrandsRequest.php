<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBrandsRequest extends FormRequest
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
            'name' => 'required|max:25',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Brand tidak boleh kosong!',
            'name.max' => 'Nama Brand maksimal 25 karakter',
        ];
    }
}
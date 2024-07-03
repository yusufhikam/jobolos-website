<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDateRequest extends FormRequest
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
            'tanggal' => 'required|date|after:today',
        ];
    }

    public function messages()
    {
        return [
            'tanggal.required' => 'Tolong tentukan tanggal',
            'tanggal.date' => 'Hanya bisa menerima inputan tanggal',
            'tanggal.after' => 'Pengeditan tanggal tidak dapat memilih tanggal yang telah lewat',
        ];
    }
}

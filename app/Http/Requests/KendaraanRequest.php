<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KendaraanRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'merk' => 'required|string',
            'tahun' => 'required|numeric',
            'warna' => 'required|string',
            'harga' => 'required|numeric'
        ];
    }

     /**
     * Custom messages for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'merk.required' => 'Merk wajib diisi!',
            'tahun.required' => 'Tahun wajib diisi',
            'warna.required' => 'Warna wajib diisi',
            'harga.required' => 'Harga wajib diisi'
        ];
    }
    protected $redirect = '/api/kendaraan/error/validation';
}

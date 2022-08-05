<?php

namespace App\Http\Requests\v1\Reference;

use App\Http\Requests\BaseRequest;

class ProvinceRequest extends BaseRequest
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
            'prov_code' => 'required|string',
            'prov_name' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'prov_code.required' => 'Kolom kode provinsi harus diisi',
            'prov_name.required' => 'Kolom nama provinsi harus diisi',
        ];
    }
}
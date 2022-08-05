<?php

namespace App\Http\Requests\v1\Reference;

use App\Http\Requests\BaseRequest;

class RegionRequest extends BaseRequest
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
            'reg_code' => 'required|string',
            'reg_prov_code' => 'required|string',
            'reg_name' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'reg_code.required' => 'Kolom kode region harus diisi',
            'reg_prov_code.required' => 'Kolom kode provinsi harus diisi',
            'reg_name.required' => 'Kolom nama region harus diisi',
        ];
    }
}
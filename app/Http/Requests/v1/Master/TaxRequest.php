<?php

namespace App\Http\Requests\v1\Master;

use App\Http\Requests\BaseRequest;

class TaxRequest extends BaseRequest
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
            'tax_name' => 'required|string',
            'tax_rate' => 'required:regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    public function messages()
    {
        return [
            'tax_name.required' => 'Kolom nama harus diisi',
            'tax_rate.required' => 'Kolom rate harus diisi',
            'tax_rate.regex' => 'Kolom rate harus berupa pecahan desimal',
        ];
    }
}
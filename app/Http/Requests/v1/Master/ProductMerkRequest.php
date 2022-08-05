<?php

namespace App\Http\Requests\v1\Master;

use App\Http\Requests\BaseRequest;

class ProductMerkRequest extends BaseRequest
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
            'prodmerk_company_id' => 'integer',
            'prodmerk_outlet_id' => 'integer',
            'prodmerk_name' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'prodmerk_company_id.integer' => 'Kolom company harus berupa bilangan bulat',
            'prodmerk_outlet_id.integer' => 'Kolom outlet harus berupa bilangan bulat',
            'prodmerk_name.required' => 'Kolom nama harus diisi',
        ];
    }
}
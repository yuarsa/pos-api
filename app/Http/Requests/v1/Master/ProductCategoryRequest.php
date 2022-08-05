<?php

namespace App\Http\Requests\v1\Master;

use App\Http\Requests\BaseRequest;

class ProductCategoryRequest extends BaseRequest
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
            'prodcat_company_id' => 'integer',
            'prodcat_outlet_id' => 'required|integer',
            'prodcat_name' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'prodcat_company_id.integer' => 'Kolom company harus berupa bilangan bulat',
            'prodcat_outlet_id.required' => 'Kolom outlet harus diisi',
            'prodcat_outlet_id.integer' => 'Kolom outlet harus berupa bilangan bulat',
            'prodcat_name.required' => 'Kolom nama harus diisi',
        ];
    }
}
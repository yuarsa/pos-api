<?php

namespace App\Http\Requests\v1\Master;

use App\Http\Requests\BaseRequest;

class VarianRequest extends BaseRequest
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
            'vars_id' => 'required|integer',
            'vars_name' => 'required|string',
            
        ];
    }

    public function messages()
    {
        return [
            'vars_id.required' => 'Kolom kategori produk harus diisi',           
            'vars_name.required' => 'Kolom nama produk harus diisi',
          
        ];
    }
}
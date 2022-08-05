<?php

namespace App\Http\Requests\v1\Master;

use App\Http\Requests\BaseRequest;

class VarianValueRequest extends BaseRequest
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
            'val_id' => 'required|integer',
            'val_variant_id' => 'required|string',
            'val_value' => 'required|string',
            
        ];
    }

    public function messages()
    {
        return [
            'val_variant_id' => 'Kolom kategori produk harus diisi',           
            'val_value' => 'Kolom nama produk harus diisi',
          
        ];
    }
}
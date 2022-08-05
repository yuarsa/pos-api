<?php

namespace App\Http\Requests\v1\Master;

use App\Http\Requests\BaseRequest;

class ProductRequest extends BaseRequest
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
            'prod_category_id' => 'required|integer',
            'prod_merk_id' => 'required|integer',
            'prod_name' => 'required|string',
            'prod_price_sell' => 'required',
            'prod_price_purchase' => 'required',
            'prod_stock' => 'required',
            'prod_is_sell' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'prod_category_id.required' => 'Kolom kategori produk harus diisi',
            'prod_merk_id.required' => 'Kolom merk produk harus diisi',
            'prod_name.required' => 'Kolom nama produk harus diisi',
            'prod_price_sell.required' => 'Kolom harga jual produk harus diisi',
            'prod_price_purchase.required' => 'Kolom harga beli produk harus diisi',
            'prod_stock.required' => 'Kolom stok produk harus diisi',
            'prod_is_sell.required' => 'Kolom jual produk harus diisi',
        ];
    }
}
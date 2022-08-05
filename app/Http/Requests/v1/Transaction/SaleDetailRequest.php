<?php

namespace App\Http\Requests\v1\Transaction;

use App\Http\Requests\BaseRequest;

class SaleDetailRequest extends BaseRequest
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
            'saledet_sale_id' => 'required|integer',
            'saledet_product_id' => 'required|integer',
            'saledet_qty' => 'required|integer',
            'saledet_price' => 'required',
            'saledet_total' => 'required',
            'saledet_grand_total' => 'required',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
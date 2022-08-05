<?php

namespace App\Http\Requests\v1\Transaction;

use App\Http\Requests\BaseRequest;

class SaleRequest extends BaseRequest
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
            'sale_outlet_id' => 'required|integer',
            'sale_date' => 'required|date',
            'sale_cashier' => 'required|string',
            'sale_customer_id' => 'required|integer',
            'sale_total' => 'required',
            'sale_grand_total' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'sale_outlet_id.required' => 'Kolom outlet harus diisi',
            'sale_outlet_id.integer' => 'Kolom outlet harus berupa bilangan bulat',
            'sale_cashier.required' => 'Kolom nama kasir harus diisi',
            'sale_customer_id.required' => 'Kolom customer harus diisi',
            'sale_customer_id.integer' => 'Kolom customer harus berupa bilangan bulat',
            'sale_total.required' => 'Kolom total harus diisi',
            'sale_grand_total.required' => 'Kolom grand total harus diisi',
        ];
    }
}
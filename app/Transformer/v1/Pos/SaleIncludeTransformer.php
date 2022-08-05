<?php

namespace App\Transformer\v1\Pos;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Transaction\Sale;
use App\Models\Master\Employee;

class SaleIncludeTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'items'
    ];

    public function transform(Sale $sale)
    {
       
        // $user = \Auth::user();
        // $employee = Employee::find($user->employee_id);
        
     
        
        if($sale->sale_type == 1) {
            $type = 'Sistem';
        } else if($sale->sale_type == 2) {
            $type = 'POS';
        }
        
        if($sale->sale_payment_type == 1) {
            $payment_type = 'Cash';
        } else if($sale->sale_payment_type == 2) {
            $payment_type = 'Debit';
        } else if($sale->sale_payment_type == 3) {
            $payment_type = 'Kredit';
        } else {
            $payment_type = 'Undifined';
        }

        if($sale->tax) {
            $tax = [
                'name' => $sale->tax->tax_name,
                'rate' => $sale->tax->tax_rate,
                'amount' => (double) $sale->sale_tax
            ];
        } else {
            $tax = [];
        }

        $formatted = [
            'id' => $sale->sale_id,
            'uuid' => $sale->sale_uuid,
            'type' => [
                'value' => $sale->sale_type,
                'name' => $type
            ],
            'outlet' => ($sale->outlet) ? $sale->outlet : '',
            'employee' => $sale->employee,
            'code' => $sale->sale_code,
            'date' => (String) $sale->sale_date,
            'cashier' => $sale->sale_cashier,
            'customer' => ($sale->customer) ? $sale->customer->cus_name : '',
            'amount' => (double) $sale->sale_total,
            'discount' => (double) $sale->sale_discount,
            'tax' => $tax,
            'total' => (double) $sale->sale_total,
            'payment' => [
                'name' => $payment_type,
                'amount' => $sale->sale_payment_amount,
                'balance' => $sale->sale_payment_balance
            ]
        ];

        return $formatted;
    }

    public function includeItems(Sale $sale)
    {
        if(!$sale->items) {
            return null;
        }
        // $dt = $sale->with(['items.varian'])->get();
        // dd($dt);

        return $this->collection($sale->items, app()->make(SaleDetailTransformer::class));
    }
}
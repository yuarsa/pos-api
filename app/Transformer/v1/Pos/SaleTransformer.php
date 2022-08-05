<?php

namespace App\Transformer\v1\Pos;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Transaction\Sale;

class SaleTransformer extends TransformerAbstract
{
    public function transform(Sale $sale)
    {
        if($sale->type == 1) {
            $type = 'Sistem';
        } else if($sale->type == 2) {
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

        $formatted = [
            'uuid' => $sale->sale_uuid,
            'type' => [
                'value' => $sale->type,
                'name' => $type
            ],
            'outlet' => ($sale->outlet) ? $sale->outlet->out_name : '',
            'code' => $sale->sale_code,
            'date' => $sale->sale_date->toDateTimeString(),
            'cashier' => $sale->sale_cashier,
            'customer' => ($sale->customer) ? $sale->customer->cus_name : '',
            'amount' => (double) $sale->sale_total,
            'discount' => (double) $sale->sale_discount,
            'tax' => [
                'name' => $sale->tax->tax_name,
                'rate' => $sale->tax->tax_rate,
                'amount' => (double) $sale->sale_tax
            ],
            'total' => (double) $sale->sale_grand_total,
            'payment' => [
                'name' => $payment_type,
                'amount' => $sale->sale_payment_amount,
                'balance' => $sale->sale_payment_balance
            ]
        ];

        return $formatted;
    }
}
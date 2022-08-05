<?php

namespace App\Transformer\v1\Transaction;

use League\Fractal\TransformerAbstract;
use App\Models\Transaction\Sale;

class SaleOrderTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'items'
    ];

    public function transform(Sale $sale)
    {
        if($sale->sale_type == 1) {
            $type = 'Sistem';
        } else if($sale->sale_type == 2) {
            $type = 'POS';
        }

        if($sale->outlet) {
            $outlet = [
                'id' => $sale->outlet->out_id,
                'name' => $sale->outlet->out_name,
            ];
        } else {
            $outlet = [];
        }

        if($sale->customer) {
            $customer = [
                'id' => $sale->customer->cus_id,
                'name' => $sale->customer->cus_name
            ];
        } else {
            $customer = [];
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
            'id' => $sale->sale_id,
            'uuid' => $sale->sale_uuid,
            'code' => $sale->sale_code,
            'type' => [
                'value' => $sale->type,
                'name' => $type
            ],
            'outlet' => $outlet,
            'date' => (String) $sale->sale_date,
            'cashier' => $sale->sale_cashier,
            'customer' => $customer,
            'amount' => (double) $sale->sale_total,
            'discount' => (double) $sale->sale_discount,
            'tax' => $tax,
            'total' => (double) $sale->sale_grand_total,
            'payment' => [
                'name' => $payment_type,
                'amount' => (double) $sale->sale_payment_amount,
                'balance' => (double) $sale->sale_payment_balance
            ]
        ];

        return $formatted;
    }

    public function includeItems(Sale $sale)
    {
        if(!$sale->items) {
            return null;
        }

        return $this->collection($sale->items, app()->make(SaleOrderDetailTransformer::class));
    }
}
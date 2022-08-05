<?php

namespace App\Transformer\v1\Transaction;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Transaction\SaleDetail;

class SaleOrderDetailTransformer extends TransformerAbstract
{
    public function transform(SaleDetail $saleDetail)
    {
        if($saleDetail->product) {
            $produk = [
                'id' => $saleDetail->product->prod_id,
                'name' => $saleDetail->product->prod_name,
            ];
        } else {
            $produk = [];
        }

        if($saleDetail->tax) {
            $tax = [
                'name' => $saleDetail->tax->tax_name,
                'rate' => $saleDetail->tax->tax_rate,
                'amount' => (double) $saleDetail->sale_tax
            ];
        } else {
            $tax = [];
        }

        $formatted = [
            'id' => $saleDetail->saledet_id,
            'uuid' => $saleDetail->saledet_uuid,
            'product' => $produk,
            'qty' => (int) $saleDetail->saledet_qty,
            'price' => (double) $saleDetail->saledet_price,
            'discount' => [
                'percent' => (double) $saleDetail->saledet_discount_percent,
                'nominal' => (double) $saleDetail->saledet_discount_percent,
            ],
            'tax' => $tax,
            'subtotal' => (double) $saleDetail->saledet_total,
            'total' => (double) $saleDetail->saledet_grand_total,
        ];

        return $formatted;
    }
}
<?php

namespace App\Transformer\v1\Transaction;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Transaction\ReceivedOrderDetail;

class ReceivedOrderDetailTransformer extends TransformerAbstract
{
    public function transform(ReceivedOrderDetail $receivedOrderDetail)
    {
        if($receivedOrderDetail->product) {
            $produk = [
                'id' => $receivedOrderDetail->product->prod_id,
                'name' => $receivedOrderDetail->product->prod_name,
            ];
        } else {
            $produk = [];
        }

        $formatted = [
            'id' => $receivedOrderDetail->rcvd_id,
            'product' => $produk,
            'qty' => (int) $receivedOrderDetail->rcvd_qty,
            'status' => $receivedOrderDetail->rcvd_status,
        ];

        return $formatted;
    }
}
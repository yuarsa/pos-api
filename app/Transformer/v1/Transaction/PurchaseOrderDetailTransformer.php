<?php

namespace App\Transformer\v1\Transaction;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Transaction\PurchaseOrderDetail;

class PurchaseOrderDetailTransformer extends TransformerAbstract
{
    public function transform(PurchaseOrderDetail $purchaseOrderDetail)
    {
        if($purchaseOrderDetail->product) {
            $produk = [
                'id' => $purchaseOrderDetail->product->prod_id,
                'name' => $purchaseOrderDetail->product->prod_name,
            ];
        } else {
            $produk = [];
        }

        $formatted = [
            'id' => $purchaseOrderDetail->pod_id,
            'uuid' => $purchaseOrderDetail->pod_uuid,
            'product' => $produk,
            'description' => $purchaseOrderDetail->pod_description,
            'qty' => (int) $purchaseOrderDetail->pod_qty,
            'price' => (double) $purchaseOrderDetail->pod_price,
            'tax' => (double) $purchaseOrderDetail->pod_tax,
            'total' => (double) $purchaseOrderDetail->pod_total,
        ];

        return $formatted;
    }
}
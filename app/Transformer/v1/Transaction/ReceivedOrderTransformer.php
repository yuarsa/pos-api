<?php

namespace App\Transformer\v1\Transaction;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Transaction\ReceivedOrder;

class ReceivedOrderTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'items'
    ];

    public function transform(ReceivedOrder $receivedOrder)
    {
        if($receivedOrder->purchase) {
            $po = [
                'id' => $receivedOrder->purchase->po_id,
                'code' => $receivedOrder->purchase->po_id,
            ];
        } else {
            $po = [];
        }
        
        if($receivedOrder->rcv_status == 1) {
            $status = [
                'id' => 1,
                'name' => 'Dalam Proses'
            ];
        } else if($receivedOrder->rcv_status == 2) {
            $status = [
                'id' => 2,
                'name' => 'Selesai'
            ];
        } else {
            $status = [];
        }

        $formatted = [
            'id' => $receivedOrder->rcv_id,
            'purchase' => $po,
            'code' => $receivedOrder->rcv_code,
            'date' => (String) $receivedOrder->rcv_date,
            'ship_number' => $receivedOrder->rcv_shipping_number,
            'ship_name' => $receivedOrder->rcv_shipping_name,
            'description' => $receivedOrder->rcv_description,
            'status' => $status,
            'created' => (String) $receivedOrder->created_at,
            'updated' => (String) $receivedOrder->updated_at,
        ];

        return $formatted;
    }

    public function includeItems(ReceivedOrder $receivedOrder)
    {
        if(!$receivedOrder->items) {
            return null;
        }

        return $this->collection($receivedOrder->items, app()->make(ReceivedOrderDetailTransformer::class));
    }
}
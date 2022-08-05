<?php

namespace App\Transformer\v1\Dashboard;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Master\Customer;

class DashboardTransformer extends TransformerAbstract
{
    // protected $defaultIncludes = [
    //     'items'
    // ];

    protected $data = [];

    public function transform($data)
    {
        // if($receivedOrder->purchase) {
        //     $po = [
        //         'id' => $receivedOrder->purchase->po_id,
        //         'code' => $receivedOrder->purchase->po_id,
        //     ];
        // } else {
        //     $po = [];
        // }
        
        // if($receivedOrder->rcv_status == 1) {
        //     $status = [
        //         'id' => 1,
        //         'name' => 'Dalam Proses'
        //     ];
        // } else if($receivedOrder->rcv_status == 2) {
        //     $status = [
        //         'id' => 2,
        //         'name' => 'Selesai'
        //     ];
        // } else {
        //     $status = [];
        // }

        $formatted = [
            // 'created' => (String) $customer->created_at,
            // 'updated' => (String) $customer->updated_at,
            "count" => $data['count'],
            "sale"=>$data['sale']
            // "customer" => $data->customer,
            // "employe" => $data->employee
        ];

        return $formatted;
    }

    // public function includeItems(ReceivedOrder $receivedOrder)
    // {
    //     if(!$receivedOrder->items) {
    //         return null;
    //     }

    //     return $this->collection($receivedOrder->items, app()->make(ReceivedOrderDetailTransformer::class));
    // }
}
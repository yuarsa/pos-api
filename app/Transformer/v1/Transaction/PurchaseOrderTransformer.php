<?php

namespace App\Transformer\v1\Transaction;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Transaction\PurchaseOrder;

class PurchaseOrderTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'items'
    ];

    public function transform(PurchaseOrder $purchaseOrder)
    {
        if($purchaseOrder->company) {
            $company = [
                'id' => $purchaseOrder->company->comp_id,
                'name' => $purchaseOrder->company->comp_name,
            ];
        } else {
            $company = [];
        }

        if($purchaseOrder->outlet) {
            $outlet = [
                'id' => $purchaseOrder->outlet->out_id,
                'name' => $purchaseOrder->outlet->out_name,
            ];
        } else {
            $outlet = [];
        }

        if($purchaseOrder->supplier) {
            $supplier = [
                'id' => $purchaseOrder->supplier->sup_id,
                'name' => $purchaseOrder->supplier->sup_name,
            ];
        } else {
            $supplier = [];
        }

        if($purchaseOrder->paymentTerms) {
            $term = [
                'id' => $purchaseOrder->paymentTerms->payterm_id,
                'name' => $purchaseOrder->paymentTerms->payterm_name,
                'periode' => $purchaseOrder->paymentTerms->payterm_periode,
            ];
        } else {
            $term = [];
        }
        
        if($purchaseOrder->po_status == 1) {
            $status = [
                'id' => 1,
                'name' => 'Pengajuan'
            ];
        } else if($purchaseOrder->po_status == 2) {
            $status = [
                'id' => 2,
                'name' => 'Disetujui & Dalam Proses'
            ];
        } else if ($purchaseOrder->po_status == 3) {
            $status = [
                'id' => 3,
                'name' => 'Selesai'
            ];
        } else {
            $status = [];
        }

        $formatted = [
            'id' => $purchaseOrder->po_id,
            'uuid' => $purchaseOrder->po_uuid,
            'code' => $purchaseOrder->po_code,
            'company' => $company,
            'outlet' => $outlet,
            'supplier' => $supplier,
            'reference' => $purchaseOrder->po_supplier_reference,
            'date' => (String) $purchaseOrder->po_date,
            'date_due' => (String) $purchaseOrder->po_date_due,
            'term' => $term,
            'note' => $purchaseOrder->po_note,
            'memo' => $purchaseOrder->po_memo,
            'status' => $status,
            'amount' => $purchaseOrder->po_amount,
            'discount' => $purchaseOrder->po_discount,
            'tax' => $purchaseOrder->po_tax,
            'total' => $purchaseOrder->po_total,
            'created' => (String) $purchaseOrder->created_at,
            'updated' => (String) $purchaseOrder->updated_at,
        ];

        return $formatted;
    }

    public function includeItems(PurchaseOrder $purchaseOrder)
    {
        if(!$purchaseOrder->items) {
            return null;
        }

        return $this->collection($purchaseOrder->items, app()->make(PurchaseOrderDetailTransformer::class));
    }
}
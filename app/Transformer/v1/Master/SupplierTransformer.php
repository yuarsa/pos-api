<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use App\Models\Master\Supplier;
use Carbon\Carbon;

class SupplierTransformer extends TransformerAbstract
{
    public function transform(Supplier $supplier)
    {
        if($supplier->province) {
            $prov = [
                'prov_code' => $supplier->province->prov_code,
                'prov_name' => $supplier->province->prov_name
            ];
        } else {
            $prov = [];
        }

        if($supplier->regency) {
            $reg = [
                'reg_code' => $supplier->regency->reg_code,
                'reg_name' => $supplier->regency->reg_name
            ];
        } else {
            $reg = [];
        }

        $formatted = [
            'uuid' => $supplier->sup_uuid,  
            'code' => 'SUP'.$supplier->sup_code.$supplier->sup_comp_id,  
            'name' => $supplier->sup_name,
            'birthday' => Carbon::parse($supplier->sup_birthday)->format('d F Y'),
            'email' => $supplier->sup_email,
            'phone' => $supplier->sup_phone,
            'address' => $supplier->sup_address,
            'province' => $prov,
            'region' => $reg,
            'postal_code' => $supplier->sup_postal_code,
            'enabled' => $supplier->sup_enabled,
            'created' => $supplier->created_at->toDateTimeString(),
            'updated' => $supplier->created_at->toDateTimeString(),
        ];

        return $formatted;
    }
}
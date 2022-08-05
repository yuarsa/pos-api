<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Master\Outlet;

class OutletTransformer extends TransformerAbstract
{
    public function transform(Outlet $outlet)
    {
        if($outlet->province) {
            $prov = [
                'prov_code' => $outlet->province->prov_code,
                'prov_name' => $outlet->province->prov_name
            ];
        } else {
            $prov = [];
        }

        if($outlet->regency) {
            $reg = [
                'reg_code' => $outlet->regency->reg_code,
                'reg_name' => $outlet->regency->reg_name
            ];
        } else {
            $reg = [];
        }

        $formatted = [
            'id' => $outlet->out_id,
            'uuid' => $outlet->out_uuid,
            'company' => $outlet->company->comp_name,
            'name' => $outlet->out_name,
            'email' => $outlet->out_email,
            'phone' => $outlet->out_phone,
            'address' => $outlet->out_address,
            'province' => $prov,
            'regency' => $reg,
            'created' => $outlet->created_at->toDateTimeString(),
            'updated' => $outlet->updated_at->toDateTimeString(),
        ];

        return $formatted;
    }
}
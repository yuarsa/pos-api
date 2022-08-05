<?php

namespace App\Transformer\v1\Reference;

use League\Fractal\TransformerAbstract;
use App\Models\Reference\Province;

class ProvinceTransformer extends TransformerAbstract
{
    public function transform(Province $province)
    {
        $formatted = [
            'code' => $province->prov_code,  
            'name' => $province->prov_name,  
            'created' => (String) $province->created_at,
            'updated' => (String) $province->updated_at,
        ];

        return $formatted;
    }
}
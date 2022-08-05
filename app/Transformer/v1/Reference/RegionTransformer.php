<?php

namespace App\Transformer\v1\Reference;

use League\Fractal\TransformerAbstract;
use App\Models\Reference\Region;

class RegionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    protected $defaultIncludes = [];

    public function transform(Region $region)
    {
        $formatted = [
            'code' => $region->reg_code,  
            'name' => $region->reg_name,
            'created' => (String) $region->created_at,
            'updated' => (String) $region->updated_at,
            'province' => [
                'code' => $region->province->prov_code,
                'name' => $region->province->prov_name,
            ],
        ];

        return $formatted;
    }
}
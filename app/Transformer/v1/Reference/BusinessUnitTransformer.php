<?php

namespace App\Transformer\v1\Reference;

use League\Fractal\TransformerAbstract;
use App\Models\Reference\BusinessUnit;

class BusinessUnitTransformer extends TransformerAbstract
{
    public function transform(BusinessUnit $businessUnit)
    {
        $formatted = [
            'id' => $businessUnit->ub_id,  
            'name' => $businessUnit->ub_name,  
            'created' => (String) $businessUnit->created_at,
            'updated' => (String) $businessUnit->updated_at,
        ];

        return $formatted;
    }
}
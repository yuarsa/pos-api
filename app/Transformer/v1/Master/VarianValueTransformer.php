<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use App\Models\Master\VarianValue;

class VarianValueTransformer extends TransformerAbstract
{
    public function transform(VarianValue $varianvalue)
    {
        $formatted = [
            'val_id' => $varianvalue->val_id,  
            'val_variant_id' => $varianvalue->val_variant_id,
            'val_value' => $varianvalue->val_value,  
            'val_variant_id_2' => $varianvalue->val_variant_id,
            'val_value_2' => $varianvalue->val_value,  
            'created' => (String) $varianvalue->created_at,
            'updated' => (String) $varianvalue->updated_at,
        ];

        return $formatted;
    }
}
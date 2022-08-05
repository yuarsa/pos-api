<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use App\Models\Master\Varian;

class VarianTransformer extends TransformerAbstract
{
    public function transform(Varian $varian)
    {
        $formatted = [
            'code' => $varian->vars_id,  
            'name' => $varian->vars_name,  
            'created' => (String) $varian->created_at,
            'updated' => (String) $varian->updated_at,
        ];

        return $formatted;
    }
}
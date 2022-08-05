<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use App\Models\Master\ProductVarian;

class ProductVarianTransformer extends TransformerAbstract
{
    public function transform(ProductVarian $productvarian)
    {
   dd($productvarian->all());
        $formatted = [
            'prodvar_product_id' => $productvarian->prodvar_product_id,  
            'prodvar_value_id' => $productvarian->prodvar_value_id,  
            'prodvar_price' => $productvarian->prodvar_price,  
            'prodvar_stock' => $productvarian->prodvar_stock,  
            'created' => (String) $productvarian->created_at,
            'updated' => (String) $productvarian->updated_at,
        ];

        return $formatted;
    }
}

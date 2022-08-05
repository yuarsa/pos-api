<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use App\Models\Master\ProductWholesaler;

class ProductWholesalerTransformer extends TransformerAbstract
{
    public function transform(ProductWholesaler $productWholesaler)
    {   
        if($productWholesaler->product) {
            $product = [
                'id' => $productWholesaler->product->prod_id,
                'name' => $productWholesaler->product->prod_name,
            ];
        } else {
            $product = [];
        }

        if($productWholesaler->prodwho_enabled == true) {
            $enabled = [
                'status' => true,
                'label' => 'Active'
            ];
        } else {
            $enabled = [
                'status' => false,
                'label' => 'Inactive'
            ];
        }

        $formatted = [
            'id' => $productWholesaler->prodwho_id,
            'product' => $product,
            'min' => (double) $productWholesaler->prodwho_qty_min,
            'max' => (double) $productWholesaler->prodwho_qty_max,
            'price' => (double) $productWholesaler->prodwho_price,
            'type' => (double) $productWholesaler->prodwho_price,
            'enabled' => $enabled,
            'created' => $productWholesaler->created_at->toDateTimeString(),
            'updated' => $productWholesaler->updated_at->toDateTimeString(),
        ];

        return $formatted;
    }
}
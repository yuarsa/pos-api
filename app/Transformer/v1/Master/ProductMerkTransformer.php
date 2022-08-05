<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Master\ProductMerk;

class ProductMerkTransformer extends TransformerAbstract
{
    public function transform(ProductMerk $productMerk)
    {   
        if($productMerk->outlet) {
            $outlet = [
                'id' => $productMerk->outlet->out_id,
                'name' => $productMerk->outlet->out_name,
            ];
        } else {
            $outlet = [];
        }

        $formatted = [
            'id' => $productMerk->prodmerk_id,
            'uuid' => $productMerk->prodmerk_uuid,
            'company' => $productMerk->company->comp_name,
            'outlet' => $outlet,
            'name' => $productMerk->prodmerk_name,
            'description' => $productMerk->prodmerk_description,
            'created' => $productMerk->created_at->toDateTimeString(),
            'updated' => $productMerk->updated_at->toDateTimeString(),
        ];

        return $formatted;
    }
}
<?php

namespace App\Transformer\v1\Pos;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Master\Product;

class ProductVarianTransformer extends TransformerAbstract
{
    public function transform(Product $product)
    {
        $formatted = [
            'id' => $product->prod_id,
            'uuid' => $product->prod_uuid,
            'merk' => $product->merk->prodmerk_name,
            'name' => $product->prod_name,
            'sku' => $product->prod_sku,
            'unit' => $product->prod_unit,
            'price_sell' => (double) $product->prod_price_sell,
            'serial' => $product->prod_serial,
            'barcode' => $product->prod_barcode,
            'serial' => $product->prod_serial,
            'stock' => $product->prod_stock,
            'image' => $product->prod_image,
            'stock' => $product->prod_stock,
        ];

        return $formatted;
    }
}
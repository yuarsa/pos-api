<?php

namespace App\Transformer\v1\Pos;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Master\Product;
use Illuminate\Support\Facades\DB;

class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $product)
    {
        
        $varian=[];
        $prodvar=[];
         $productvarian=DB::table('mst_product_variants')
        ->join('mst_variant_values', 'mst_product_variants.prodvar_value_id', '=', 'mst_variant_values.val_id')
        ->join('mst_variants', 'mst_variant_values.val_variant_id', '=', 'mst_variants.vars_id')
        ->where('prodvar_product_id','=',$product->prod_id)
        ->select('val_id','val_value','vars_id','vars_name')
        ->get();

        $productvarian2=DB::table('mst_product_variants')
        ->join('mst_variant_values', 'mst_product_variants.prodvar_value_id', '=', 'mst_variant_values.val_id')
        ->join('mst_variants', 'mst_variant_values.val_variant_id_2', '=', 'mst_variants.vars_id')
        ->where('prodvar_product_id','=',$product->prod_id)
        ->select('val_id','val_value_2','vars_id','vars_name')
        ->get();

        $i = count($productvarian);

        for($a=0;$a<$i;$a++){

            if (isset($productvarian2[$a]->val_value_2)) {
               $varian[]=[
                'varsname1'=>$productvarian[$a],
                'varsname2'=>$productvarian2[$a]
            ];

        } else {
            $varian[]=[
                'varsname1'=>$productvarian[$a],
               
            ];
        }


    }

    if($product->prodvar) {
        foreach ($product->prodvar as $var){

            $prodvar[]=[
                'prodvar_id'=>$var->prodvar_id,
                'prodvar_product_id'=>$var->prodvar_product_id,
                'prodvar_value_id'=>$var->prodvar_value_id,
                'prodvar_price'=>$var->prodvar_price,
                'prodvar_stock'=>$var->prodvar_stock,

            ];
        }
    } else {
        $prodvar = [];
    }

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
            'varian' => $varian,
            'prodvar' => $prodvar,
        ];

        return $formatted;
    }
}
<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Master\Product;
use App\Models\Master\ProductVarian;
use Illuminate\Support\Facades\DB;

class ProductTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'productWholesaler'
    ];

    public function transform(Product $product)
    {
        $varian=[];
        $prodvar=[];

        if($product->company) {
            $company = [
                'id' => $product->company->comp_id,
                'name' => $product->company->comp_name,
            ];
        } else {
            $company = [];
        }

        if($product->outlet) {
            $outlet = [
                'id' => $product->outlet->out_id,
                'name' => $product->outlet->out_name,
            ];
        } else {
            $outlet = [];
        }

        if($product->category) {
            $category = [
                'id' => $product->category->prodcat_id,
                'name' => $product->category->prodcat_name,
                'shopee' => $product->category->prodcat_shopee,
            ];
        } else {
            $category = [];
        }

        if($product->merk) {
            $merk = [
                'id' => $product->merk->prodmerk_id,
                'name' => $product->merk->prodmerk_name,
            ];
        } else {
            $merk = [];
        }

        if($product->prod_in_stock == true) {
            $instock = [
                'status' => true,
                'label' => 'Yes',
            ];
        } else {
            $instock = [
                'status' => false,
                'label' => 'No',
            ];
        }

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
                'prodvar_purchase_price'=>$var->prodvar_purchase_price,
                'prodvar_stock'=>$var->prodvar_stock,

            ];
        }
    } else {
        $prodvar = [];
    }

    $formatted = [
        'id' => $product->prod_id,
        'uuid' => $product->prod_uuid,
        'company' => $company,
        'outlet' => $outlet,
        'category' => $category,
        'merk' => $merk,
        'varian_value' => $varian,
        'varian' =>$prodvar,
        'name' => $product->prod_name,
        'sku' => $product->prod_sku,
        'unit' => $product->prod_unit,
        'description' => $product->prod_description,
        'price_sell' => (double) $product->prod_price_sell,
        'price_purchase' => (double) $product->prod_price_purchase,
        'serial' => $product->prod_serial,
        'barcode' => $product->prod_barcode,
        'serial' => $product->prod_serial,
        'stock' => $product->prod_stock,
        'instock' => $instock,
        'image' => $product->prod_image,
        'stock' => $product->prod_stock,
        'sell' => $product->prod_is_sell,
        'status' => $product->prod_enabled,
        'status_label' => ($product->prod_enabled == true) ? 'Active' : 'Inactive',
        'created' => $product->created_at->toDateTimeString(),
        'updated' => $product->updated_at->toDateTimeString(),
    ];

    return $formatted;
}

public function includeproductWholesaler(Product $product)
{
    if(!$product->productWholesaler) {
        return null;
    }

    return $this->collection($product->productWholesaler, app()->make(ProductWholesalerTransformer::class));
}
}

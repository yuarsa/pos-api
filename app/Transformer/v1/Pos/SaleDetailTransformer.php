<?php

namespace App\Transformer\v1\Pos;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Transaction\SaleDetail;
use App\Models\Master\VarianValue;
use App\Models\Master\Varian;

class SaleDetailTransformer extends TransformerAbstract
{
    public function transform(SaleDetail $saleDetail)
    {
        if($saleDetail->tax) {
            $tax = [
                'name' => $saleDetail->tax->tax_name,
                'rate' => $saleDetail->tax->tax_rate,
                'amount' => (double) $saleDetail->sale_tax
            ];
        } else {
            $tax = [];
        }
        // dd($saleDetail->varian);
        // $var_name = Varian::where('val_id',$saleDetail->varian->prodvar_value_id)->get();
        if($saleDetail->varian){
            $var_val = VarianValue::with(['varian_1','varian_2'])->where('val_id',$saleDetail->varian->prodvar_value_id)->first();
        }else{
            $var_val = [];
        }
        // dd($var_val);
        $formatted = [
            'product' => $saleDetail->product->prod_name,
            'qty' => $saleDetail->saledet_qty,
            'amount' => (double) $saleDetail->saledet_price,
            'discount' => [
                'percent' => (double) $saleDetail->saledet_discount_percent,
                'nominal' => (double) $saleDetail->saledet_discount_percent,
            ],
            'tax' => $tax,
            'total' => (double) $saleDetail->saledet_grand_total,
            'varians' => $saleDetail->varian ? $saleDetail->varian : [],
            "var_value" => $var_val
        ];

        return $formatted;
    }
}
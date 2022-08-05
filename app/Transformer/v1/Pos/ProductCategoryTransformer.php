<?php

namespace App\Transformer\v1\Pos;

use League\Fractal\TransformerAbstract;
use App\Models\Master\ProductCategory;
use App\Models\Master\Product;
use App\Models\Master\Employee;

class ProductCategoryTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'products'
    ];

    public function transform(ProductCategory $category)
    {
        $formatted = [
            'uuid' => $category->prodcat_uuid,
            'category' => $category->prodcat_name,
            'label' => $category->prodcat_label
        ];

        return $formatted;
    }

    public function includeProducts(ProductCategory $category)
    {
        if(!$category->products) {
            return null;
        }   

        // dd($category->products);
        // $user = \Auth::user();
        // $employee = Employee::find($user->employee_id);
        // // $products = Product::where('prod_outlet_id', $employee->emp_out_id)->get();
        // $dt = ProductCategory::with(['products' => function($q) use($employee) {
        //     $q->where('prod_outlet_id', '=', $employee->emp_out_id); 
        // }])->get();
        // dd($dt);

        return $this->collection($category->products, app()->make(ProductTransformer::class));
    }
}
<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Master\ProductCategory;

class ProductCategoryTransformer extends TransformerAbstract
{
    public function transform(ProductCategory $productCategory)
    {
        if($productCategory->company) {
            $company = [
                'id' => $productCategory->company->comp_id,
                'name' => $productCategory->company->comp_name,
            ];
        } else {
            $company = [];
        }

        if($productCategory->outlet) {
            $outlet = [
                'id' => $productCategory->outlet->out_id,
                'name' => $productCategory->outlet->out_name,
            ];
        } else {
            $outlet = [];
        }

        if($productCategory->prodcat_enabled == true) {
            $enabled = [
                'enabled' => true,
                'label' => 'Active',
            ];
        } else {
            $enabled = [
                'enabled' => false,
                'label' => 'Inactive',
            ];
        }

        if($productCategory->prodcat_featured == true) {
            $featured = [
                'status' => true,
                'label' => 'Yes',
            ];
        } else {
            $featured = [
                'status' => false,
                'label' => 'No',
            ];
        }

        $formatted = [
            'id' => $productCategory->prodcat_id,
            'uuid' => $productCategory->prodcat_uuid,
            'company' => $company,
            'outlet' => $outlet,
            'code' => $productCategory->prodcat_code,
            'name' => $productCategory->prodcat_name,
            'slug' => $productCategory->prodcat_slug,
            'description' => $productCategory->prodcat_description,
            'parent' => $productCategory->prodcat_parent_id,
            'label' => $productCategory->prodcat_label,
            'image' => $productCategory->prodcat_image,
            'featured' => $featured,
            'enabled' => $enabled,
            'created' => $productCategory->created_at->toDateTimeString(),
            'updated' => $productCategory->updated_at->toDateTimeString(),
        ];

        return $formatted;
    }
}
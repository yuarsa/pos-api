<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\ProductCategoryContract;
use App\Models\Master\ProductCategory;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryContract
{
    public function __construct(ProductCategory $model)
    {
        $this->model = $model;
    }
}
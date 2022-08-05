<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\ProductVarianContract;
use App\Models\Master\ProductVarian;

class ProductVarianRepository extends BaseRepository implements ProductVarianContract
{
    public function __construct(ProductVarian $model)
    {
        $this->model = $model;
    }
}
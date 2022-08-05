<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\ProductContract;
use App\Models\Master\Product;

class ProductRepository extends BaseRepository implements ProductContract
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
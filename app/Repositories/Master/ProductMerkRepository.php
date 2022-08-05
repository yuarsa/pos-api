<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\ProductMerkContract;
use App\Models\Master\ProductMerk;

class ProductMerkRepository extends BaseRepository implements ProductMerkContract
{
    public function __construct(ProductMerk $model)
    {
        $this->model = $model;
    }
}
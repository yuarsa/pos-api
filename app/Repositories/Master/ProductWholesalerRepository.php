<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\ProductWholesalerContract;
use App\Models\Master\ProductWholesaler;

class ProductWholesalerRepository extends BaseRepository implements ProductWholesalerContract
{
    public function __construct(ProductWholesaler $model)
    {
        $this->model = $model;
    }
}
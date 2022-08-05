<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\SupplierContract;
use App\Models\Master\Supplier;

class SupplierRepository extends BaseRepository implements SupplierContract
{
    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }
}
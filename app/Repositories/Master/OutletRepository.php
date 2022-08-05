<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\OutletContract;
use App\Models\Master\Outlet;

class OutletRepository extends BaseRepository implements OutletContract
{
    public function __construct(Outlet $model)
    {
        $this->model = $model;
    }
}
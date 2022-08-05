<?php

namespace App\Repositories\Reference;

use App\Repositories\BaseRepository;
use App\Contracts\Reference\BusinessUnitContract;
use App\Models\Reference\BusinessUnit;

class BusinessUnitRepository extends BaseRepository implements BusinessUnitContract
{
    public function __construct(BusinessUnit $model)
    {
        $this->model = $model;
    }
}
<?php

namespace App\Repositories\Reference;

use App\Repositories\BaseRepository;
use App\Contracts\Reference\ProvinceContract;
use App\Models\Reference\Province;

class ProvinceRepository extends BaseRepository implements ProvinceContract
{
    public function __construct(Province $model)
    {
        $this->model = $model;
    }
}
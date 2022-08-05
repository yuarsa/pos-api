<?php

namespace App\Repositories\Reference;

use App\Repositories\BaseRepository;
use App\Contracts\Reference\RegionContract;
use App\Models\Reference\Region;

class RegionRepository extends BaseRepository implements RegionContract
{
    public function __construct(Region $model)
    {
        $this->model = $model;
    }
}
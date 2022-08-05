<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\VarianValueContract;
use App\Models\Master\VarianValue;

class VarianValueRepository extends BaseRepository implements VarianValueContract
{
    public function __construct(VarianValue $model)
    {
        $this->model = $model;
    }
}
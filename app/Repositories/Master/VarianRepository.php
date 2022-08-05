<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\VarianContract;
use App\Models\Master\Varian;

class VarianRepository extends BaseRepository implements VarianContract
{
    public function __construct(Varian $model)
    {
        $this->model = $model;
    }
}
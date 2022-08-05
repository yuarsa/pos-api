<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\TaxContract;
use App\Models\Master\Tax;

class TaxRepository extends BaseRepository implements TaxContract
{
    public function __construct(Tax $model)
    {
        $this->model = $model;
    }
}
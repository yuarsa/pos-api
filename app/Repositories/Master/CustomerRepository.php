<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\CustomerContract;
use App\Models\Master\Customer;

class CustomerRepository extends BaseRepository implements CustomerContract
{
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }
}
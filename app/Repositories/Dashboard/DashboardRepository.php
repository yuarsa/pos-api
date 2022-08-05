<?php

namespace App\Repositories\Dashboard;

use App\Repositories\BaseRepository;
use App\Contracts\Dashboard\DashboardContract;
use App\Models\Master\Customer;

class DashboardRepository extends BaseRepository implements DashboardContract
{
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }
}
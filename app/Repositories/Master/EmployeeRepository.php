<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;
use App\Contracts\Master\EmployeeContract;
use App\Models\Master\Employee;

class EmployeeRepository extends BaseRepository implements EmployeeContract
{
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }
}
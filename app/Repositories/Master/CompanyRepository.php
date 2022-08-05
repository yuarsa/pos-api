<?php

namespace App\Repositories\Master;

use App\Models\Master\Company;
use App\Repositories\BaseRepository;
use App\Contracts\Master\CompanyContract;

class CompanyRepository extends BaseRepository implements CompanyContract
{
    public function __construct(Company $model)
    {
        $this->model = $model;
    }
}
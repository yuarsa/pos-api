<?php

namespace App\Repositories;

use App\Contracts\BaseContract;

abstract class Criteria
{
    public abstract function apply($model, BaseContract $baseContract);
}

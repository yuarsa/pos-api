<?php

namespace App\Repositories\Transaction;

use App\Repositories\BaseRepository;
use App\Contracts\Transaction\SaleOrderContract;
use App\Models\Transaction\Sale;

class SaleOrderRepository extends BaseRepository implements SaleOrderContract
{
    public function __construct(Sale $model)
    {
        $this->model = $model;
    }
}
<?php

namespace App\Repositories\Transaction;

use App\Repositories\BaseRepository;
use App\Contracts\Transaction\SaleOrderDetailContract;
use App\Models\Transaction\SaleDetail;

class SaleOrderDetailRepository extends BaseRepository implements SaleOrderDetailContract
{
    public function __construct(SaleDetail $model)
    {
        $this->model = $model;
    }
}
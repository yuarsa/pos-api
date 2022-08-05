<?php

namespace App\Repositories\Transaction;

use App\Repositories\BaseRepository;
use App\Contracts\Transaction\TransactionDetailContract;
use App\Models\Transaction\SaleDetail;

class TransactionDetailRepository extends BaseRepository implements TransactionDetailContract
{
    public function __construct(SaleDetail $model)
    {
        $this->model = $model;
    }
}
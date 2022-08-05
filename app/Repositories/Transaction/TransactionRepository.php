<?php

namespace App\Repositories\Transaction;

use App\Repositories\BaseRepository;
use App\Contracts\Transaction\TransactionContract;
use App\Models\Transaction\Sale;

class TransactionRepository extends BaseRepository implements TransactionContract
{
    public function __construct(Sale $model)
    {
        $this->model = $model;
    }
}
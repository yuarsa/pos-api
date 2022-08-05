<?php

namespace App\Repositories\Transaction;

use App\Repositories\BaseRepository;
use App\Contracts\Transaction\ReceivedOrderContract;
use App\Models\Transaction\ReceivedOrder;

class ReceivedOrderRepository extends BaseRepository implements ReceivedOrderContract
{
    public function __construct(ReceivedOrder $model)
    {
        $this->model = $model;
    }
}
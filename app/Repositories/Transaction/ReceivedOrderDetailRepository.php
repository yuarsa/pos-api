<?php

namespace App\Repositories\Transaction;

use App\Repositories\BaseRepository;
use App\Contracts\Transaction\ReceivedOrderDetailContract;
use App\Models\Transaction\ReceivedOrderDetail;

class ReceivedOrderDetailRepository extends BaseRepository implements ReceivedOrderDetailContract
{
    public function __construct(ReceivedOrderDetail $model)
    {
        $this->model = $model;
    }
}
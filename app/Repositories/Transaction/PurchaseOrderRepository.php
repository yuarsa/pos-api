<?php

namespace App\Repositories\Transaction;

use App\Repositories\BaseRepository;
use App\Contracts\Transaction\PurchaseOrderContract;
use App\Models\Transaction\PurchaseOrder;

class PurchaseOrderRepository extends BaseRepository implements PurchaseOrderContract
{
    public function __construct(PurchaseOrder $model)
    {
        $this->model = $model;
    }
}
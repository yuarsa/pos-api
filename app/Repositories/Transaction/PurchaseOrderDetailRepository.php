<?php

namespace App\Repositories\Transaction;

use App\Repositories\BaseRepository;
use App\Contracts\Transaction\PurchaseOrderDetailContract;
use App\Models\Transaction\PurchaseOrderDetail;

class PurchaseOrderDetailRepository extends BaseRepository implements PurchaseOrderDetailContract
{
    public function __construct(PurchaseOrderDetail $model)
    {
        $this->model = $model;
    }
}
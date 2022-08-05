<?php

namespace App\Repositories\Reference;

use App\Repositories\BaseRepository;
use App\Contracts\Reference\PaymentTermContract;
use App\Models\Reference\PaymentTerm;

class PaymentTermRepository extends BaseRepository implements PaymentTermContract
{
    public function __construct(PaymentTerm $model)
    {
        $this->model = $model;
    }
}
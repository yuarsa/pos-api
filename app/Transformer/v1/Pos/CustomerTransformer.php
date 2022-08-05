<?php

namespace App\Transformer\v1\Pos;

use League\Fractal\TransformerAbstract;
use App\Models\Master\Customer;

class CustomerTransformer extends TransformerAbstract
{
    public function transform(Customer $customer)
    {
        $formatted = [
            'uuid' => $customer->cus_uuid,
            'name' => $customer->cus_name
        ];

        return $formatted;
    }
}
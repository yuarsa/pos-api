<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use App\Models\Master\Customer;
use Carbon\Carbon;

class CustomerTransformer extends TransformerAbstract
{
    public function transform(Customer $customer)
    {
        $formatted = [
            'id' => $customer->cus_id,  
            'uuid' => $customer->cus_uuid,  
            'code' => $customer->cus_code,  
            'name' => $customer->cus_name,
            'birthday' => Carbon::parse($customer->cus_birthday)->format('d F Y'),
            'email' => $customer->cus_email,
            'phone' => $customer->cus_phone,
            'address' => $customer->cus_address,
            'postal_code' => $customer->cus_postal_code,
            'enabled' => $customer->cus_enabled,
            'created' => $customer->created_at->toDateTimeString(),
            'updated' => $customer->created_at->toDateTimeString(),
        ];

        return $formatted;
    }
}
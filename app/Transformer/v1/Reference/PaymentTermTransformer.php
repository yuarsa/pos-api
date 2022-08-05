<?php

namespace App\Transformer\v1\Reference;

use League\Fractal\TransformerAbstract;
use App\Models\Reference\PaymentTerm;

class PaymentTermTransformer extends TransformerAbstract
{
    public function transform(PaymentTerm $paymentTerm)
    {
        $formatted = [
            'uuid' => $paymentTerm->payterm_id,
            'name' => $paymentTerm->payterm_name,
            'periode' => $paymentTerm->payterm_periode,
            'created' => $paymentTerm->created_at->toDateTimeString(),
            'updated' => $paymentTerm->updated_at->toDateTimeString()
        ];

        return $formatted;
    }
}
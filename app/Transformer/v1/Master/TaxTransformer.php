<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Master\Tax;

class TaxTransformer extends TransformerAbstract
{
    public function transform(Tax $tax)
    {
        $formatted = [
            'uuid' => $tax->tax_id,
            'company' => $tax->company->comp_name,
            'name' => $tax->tax_name,
            'value' => $tax->tax_rate,
            'status' => ($tax->tax_enabled == true) ? 'active' : 'Inactive',
            'created' => $tax->created_at->toDateTimeString(),
            'updated' => $tax->updated_at->toDateTimeString(),
        ];

        return $formatted;
    }
}
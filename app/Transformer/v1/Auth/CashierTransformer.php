<?php

namespace App\Transformer\v1\Auth;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Auth\User;

class CashierTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        $formatted = [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->employee->emp_name,
            'outlet_id' => $user->employee->emp_out_id,
            'outlet' => $user->employee->outlet->out_name,
            'outlet_phone' => $user->employee->outlet->out_phone,
            'outlet_prov' => $user->employee->outlet->province,
            'outlet_reg' => $user->employee->outlet->regency,
            'outlet_address' => $user->employee->outlet->out_address,
            'company_id' => $user->employee->outlet->company->comp_id,
            'company_uuid' => $user->employee->outlet->company->comp_uuid,
            'uuid' => $user->employee->emp_id,
            // 'saldo' => $user->employee->saldo
        ];

        return $formatted;
    }
}
<?php

namespace App\Transformer\v1\Master;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\Master\Employee;

class EmployeeTransformer extends TransformerAbstract
{
    public function transform(Employee $employee)
    {
 
        if($employee->emp_type == 'c' || $employee->emp_type == 'k') {
            $type = 'Chasier';
        } elseif($employee->emp_type == 'm') {
            $type = 'Manager';
        } else {
            $type = 'Not Defined';
        }
        $outlet[]=[ 
            'out_id'=> $employee->emp_out_id,
            'out_name'=> ($employee->outlet) ? $employee->outlet->out_name : '',           
                ];

        $formatted = [
            'uuid' => (String) $employee->emp_id,
            'outlet' => $outlet,
            'type' => $type,
            'name' => $employee->emp_name,
            'email' => $employee->emp_email,
            'phone' => $employee->emp_phone,
            'pin' => $employee->emp_pin,
            'status' => ($employee->emp_enabled == true) ? 'active' : 'Inactive',
            'created' => $employee->created_at->toDateTimeString(),
            'updated' => $employee->updated_at->toDateTimeString(),
        ];

        return $formatted;
    }
}
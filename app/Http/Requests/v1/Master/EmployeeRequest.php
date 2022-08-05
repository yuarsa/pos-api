<?php

namespace App\Http\Requests\v1\Master;

use App\Http\Requests\BaseRequest;

class EmployeeRequest extends BaseRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
          
            case 'POST':
            {
                return [
                    'emp_type' => 'required|string',
                    'emp_name' => 'required|string',
                    'emp_email' => 'required|email|unique:users,email',
                    'emp_phone' => 'required|string',
                    'emp_pin' => 'required|integer',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'emp_type' => 'required|string',
                    'emp_name' => 'required|string',
                    'emp_phone' => 'required|string',
                    'emp_pin' => 'required|integer',
                ];
            }
            default:break;
        }
        
    }

    public function messages()
    {
        return [
            'emp_type.required' => 'Kolom tipe harus diisi',
            'emp_name.required' => 'Kolom nama harus diisi',
            'emp_email.required' => 'Kolom email harus diisi',
            'emp_email.email' => 'Kolom email tidak valid',
            'emp_phone.required' => 'Kolom telepon harus diisi',
            'emp_pin.required' => 'Kolom pin harus diisi',
            'emp_pin.integer' => 'Kolom pin harus berupa digit',
        ];
    }
}
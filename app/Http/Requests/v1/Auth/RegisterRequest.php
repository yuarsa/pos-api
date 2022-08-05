<?php

namespace App\Http\Requests\v1\Auth;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
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
        return [
            'comp_ub_id' => 'required|integer',
            'comp_name' => 'required|string',
            'comp_email' => 'required|email',
            'comp_phone' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'comp_ub_id.required' => 'Kolom unit bisnis harus diisi',
            'comp_name.required' => 'Kolom nama harus diisi',
            'comp_email.required' => 'Kolom email harus diisi',
            'comp_email.email' => 'Kolom email tidak valid',
            'comp_phone.required' => 'Kolom telepon harus diisi',
            'password.required' => 'Kolom password harus diisi',
        ];
    }
}
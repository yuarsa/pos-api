<?php

namespace App\Http\Requests\v1\Auth;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Kolom email harus diisi',
            'email.email' => 'Kolom email tidak valid',
            'password.required' => 'Kolom password harus diisi'
        ];
    }
}
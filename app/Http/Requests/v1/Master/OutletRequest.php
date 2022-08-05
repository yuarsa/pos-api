<?php

namespace App\Http\Requests\v1\Master;

use App\Http\Requests\BaseRequest;

class OutletRequest extends BaseRequest
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
            'out_name' => 'required|string',
            'out_email' => 'required|email',
            'out_phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'out_name.required' => 'Kolom nama harus diisi',
            'out_email.required' => 'Kolom email harus diisi',
            'out_email.email' => 'Kolom email tidak valid',
            'out_phone.required' => 'Kolom telepon harus diisi'
        ];
    }
}
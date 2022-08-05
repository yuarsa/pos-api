<?php

namespace App\Http\Requests\v1\Master;

use App\Http\Requests\BaseRequest;

class CustomerRequest extends BaseRequest
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
            'cus_name' => 'required|string',
            'cus_birthday' => 'date',
            'cus_phone' => 'required',
            'cus_postal_code' => 'max:5',
        ];
    }

    public function messages()
    {
        return [
            'cus_name.required' => 'Kolom nama harus diisi',
            'cus_birthday.date' => 'Kolom tanggal lahir tidak valid',
            'cus_phone.required' => 'Kolom telepon harus diisi',
            'cus_postal_code.max' => 'Kolom kode pos maksimal 5 karakter'
        ];
    }
}
<?php

namespace App\Http\Requests\v1\Master;

use App\Http\Requests\BaseRequest;

class SupplierRequest extends BaseRequest
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
            'sup_name' => 'required|string',
            'sup_birthday' => 'date',
            'sup_email' => 'email',
            'sup_phone' => 'required',
            'sup_address' => 'required|string',
            'sup_prov_code' => 'required|string',
            'sup_reg_code' => 'required|string',
            'sup_postal_code' => 'required|max:5',
        ];
    }

    public function messages()
    {
        return [
            'sup_name.required' => 'Kolom nama harus diisi',
            'sup_birthday.date' => 'Kolom tanggal lahir tidak valid',
            'sup_email.email' => 'Kolom email tidak valid',
            'sup_phone.required' => 'Kolom telepon harus diisi',
            'sup_address.required' => 'Kolom alamat harus diisi',
            'sup_prov_code.required' => 'Kolom propinsi harus diisi',
            'sup_reg_code.required' => 'Kolom kota/kabupaten harus diisi',
            'sup_postal_code.required' => 'Kolom kode pos harus diisi',
            'sup_postal_code.max' => 'Kolom kode pos maksimal 5 karakter'
        ];
    }
}
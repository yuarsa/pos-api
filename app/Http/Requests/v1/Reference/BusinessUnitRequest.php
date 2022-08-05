<?php

namespace App\Http\Requests\v1\Reference;

use App\Http\Requests\BaseRequest;

class BusinessUnitRequest extends BaseRequest
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
            'ub_name' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'ub_name.required' => 'Kolom nama jenis usaha harus diisi',
        ];
    }
}
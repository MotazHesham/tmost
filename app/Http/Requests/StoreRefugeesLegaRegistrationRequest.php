<?php

namespace App\Http\Requests;

use App\Models\RefugeesLegaRegistration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRefugeesLegaRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('refugees_lega_registration_create');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'company' => [
                'string',
                'required',
            ],
            'position' => [
                'string',
                'required',
            ],
            'service_id' => [
                'required',
                'integer',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\RealEstateRegistration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRealEstateRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('real_estate_registration_create');
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
            'type' => [
                'required',
            ],
            'code' => [
                'string',
                'required',
            ],
            'comment' => [
                'required',
            ],
        ];
    }
}

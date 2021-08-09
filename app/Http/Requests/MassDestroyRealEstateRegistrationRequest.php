<?php

namespace App\Http\Requests;

use App\Models\RealEstateRegistration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRealEstateRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('real_estate_registration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:real_estate_registrations,id',
        ];
    }
}

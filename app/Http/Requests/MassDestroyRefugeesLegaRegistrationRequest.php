<?php

namespace App\Http\Requests;

use App\Models\RefugeesLegaRegistration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRefugeesLegaRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('refugees_lega_registration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:refugees_lega_registrations,id',
        ];
    }
}

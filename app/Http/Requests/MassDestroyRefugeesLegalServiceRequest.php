<?php

namespace App\Http\Requests;

use App\Models\RefugeesLegalService;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRefugeesLegalServiceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('refugees_legal_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:refugees_legal_services,id',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\ClientManagment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClientManagmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_managment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:client_managments,id',
        ];
    }
}

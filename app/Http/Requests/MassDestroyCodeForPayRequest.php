<?php

namespace App\Http\Requests;

use App\Models\CodeForPay;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCodeForPayRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('code_for_pay_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:code_for_pays,id',
        ];
    }
}

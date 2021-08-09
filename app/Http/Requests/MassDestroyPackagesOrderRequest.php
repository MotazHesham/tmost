<?php

namespace App\Http\Requests;

use App\Models\PackagesOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPackagesOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('packages_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:packages_orders,id',
        ];
    }
}

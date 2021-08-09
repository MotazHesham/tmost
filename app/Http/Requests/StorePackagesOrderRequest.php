<?php

namespace App\Http\Requests;

use App\Models\PackagesOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePackagesOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('packages_order_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'package_id' => [
                'required',
                'integer',
            ],
        ];
    }
}

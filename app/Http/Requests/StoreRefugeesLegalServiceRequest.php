<?php

namespace App\Http\Requests;

use App\Models\RefugeesLegalService;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRefugeesLegalServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('refugees_legal_service_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}

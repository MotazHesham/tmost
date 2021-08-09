<?php

namespace App\Http\Requests;

use App\Models\SeminarsSubscription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSeminarsSubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('seminars_subscription_create');
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
            'company' => [
                'string',
                'required',
            ],
            'position' => [
                'string',
                'required',
            ],
            'seminar_id' => [
                'required',
                'integer',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\SeminarsSubscription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySeminarsSubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('seminars_subscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:seminars_subscriptions,id',
        ];
    }
}

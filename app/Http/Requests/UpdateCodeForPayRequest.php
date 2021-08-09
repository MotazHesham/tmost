<?php

namespace App\Http\Requests;

use App\Models\CodeForPay;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCodeForPayRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('code_for_pay_edit');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
            'price' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}

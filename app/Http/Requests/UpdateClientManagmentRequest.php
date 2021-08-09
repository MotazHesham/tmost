<?php

namespace App\Http\Requests;

use App\Models\ClientManagment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientManagmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_managment_edit');
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
            'phone' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'comany' => [
                'string',
                'required',
            ],
            'position' => [
                'string',
                'required',
            ],
            'service' => [
                'required',
            ],
            'code' => [
                'string',
                'required',
            ],
        ];
    }
}

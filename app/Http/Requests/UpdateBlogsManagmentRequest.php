<?php

namespace App\Http\Requests;

use App\Models\BlogsManagment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBlogsManagmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('blogs_managment_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}

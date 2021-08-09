<?php

namespace App\Http\Requests;

use App\Models\BlogsManagment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBlogsManagmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('blogs_managment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:blogs_managments,id',
        ];
    }
}

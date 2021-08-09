@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.codeForPay.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.code-for-pays.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.codeForPay.fields.id') }}
                        </th>
                        <td>
                            {{ $codeForPay->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codeForPay.fields.code') }}
                        </th>
                        <td>
                            {{ $codeForPay->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codeForPay.fields.description') }}
                        </th>
                        <td>
                            {{ $codeForPay->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codeForPay.fields.price') }}
                        </th>
                        <td>
                            {{ $codeForPay->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codeForPay.fields.user') }}
                        </th>
                        <td>
                            {{ $codeForPay->user->email ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.code-for-pays.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
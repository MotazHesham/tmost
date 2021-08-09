@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.clientManagment.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.client-managments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientManagment.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $clientManagment->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientManagment.fields.first_name') }}
                                    </th>
                                    <td>
                                        {{ $clientManagment->first_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientManagment.fields.last_name') }}
                                    </th>
                                    <td>
                                        {{ $clientManagment->last_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientManagment.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $clientManagment->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientManagment.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $clientManagment->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientManagment.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $clientManagment->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientManagment.fields.comany') }}
                                    </th>
                                    <td>
                                        {{ $clientManagment->comany }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientManagment.fields.position') }}
                                    </th>
                                    <td>
                                        {{ $clientManagment->position }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientManagment.fields.service') }}
                                    </th>
                                    <td>
                                        {{ App\Models\ClientManagment::SERVICE_SELECT[$clientManagment->service] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientManagment.fields.code') }}
                                    </th>
                                    <td>
                                        {{ $clientManagment->code }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.client-managments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
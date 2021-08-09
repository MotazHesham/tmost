@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.refugeesLegaRegistration.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.refugees-lega-registrations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.refugeesLegaRegistration.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $refugeesLegaRegistration->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.refugeesLegaRegistration.fields.first_name') }}
                                    </th>
                                    <td>
                                        {{ $refugeesLegaRegistration->first_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.refugeesLegaRegistration.fields.last_name') }}
                                    </th>
                                    <td>
                                        {{ $refugeesLegaRegistration->last_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.refugeesLegaRegistration.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $refugeesLegaRegistration->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.refugeesLegaRegistration.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $refugeesLegaRegistration->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.refugeesLegaRegistration.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $refugeesLegaRegistration->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.refugeesLegaRegistration.fields.company') }}
                                    </th>
                                    <td>
                                        {{ $refugeesLegaRegistration->company }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.refugeesLegaRegistration.fields.position') }}
                                    </th>
                                    <td>
                                        {{ $refugeesLegaRegistration->position }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.refugeesLegaRegistration.fields.service') }}
                                    </th>
                                    <td>
                                        {{ $refugeesLegaRegistration->service->title ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.refugees-lega-registrations.index') }}">
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
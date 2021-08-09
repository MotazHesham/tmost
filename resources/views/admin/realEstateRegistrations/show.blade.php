@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.realEstateRegistration.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.real-estate-registrations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.id') }}
                        </th>
                        <td>
                            {{ $realEstateRegistration->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.first_name') }}
                        </th>
                        <td>
                            {{ $realEstateRegistration->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.last_name') }}
                        </th>
                        <td>
                            {{ $realEstateRegistration->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.email') }}
                        </th>
                        <td>
                            {{ $realEstateRegistration->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\RealEstateRegistration::TYPE_SELECT[$realEstateRegistration->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.code') }}
                        </th>
                        <td>
                            {{ $realEstateRegistration->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.comment') }}
                        </th>
                        <td>
                            {{ $realEstateRegistration->comment }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.real-estate-registrations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
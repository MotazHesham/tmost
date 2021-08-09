@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.seminarsSubscription.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seminars-subscriptions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.id') }}
                        </th>
                        <td>
                            {{ $seminarsSubscription->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.first_name') }}
                        </th>
                        <td>
                            {{ $seminarsSubscription->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.last_name') }}
                        </th>
                        <td>
                            {{ $seminarsSubscription->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.email') }}
                        </th>
                        <td>
                            {{ $seminarsSubscription->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.company') }}
                        </th>
                        <td>
                            {{ $seminarsSubscription->company }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.position') }}
                        </th>
                        <td>
                            {{ $seminarsSubscription->position }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.seminar') }}
                        </th>
                        <td>
                            {{ $seminarsSubscription->seminar->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seminars-subscriptions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
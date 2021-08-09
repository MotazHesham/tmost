@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.consultingBooking.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.consulting-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.consultingBooking.fields.id') }}
                        </th>
                        <td>
                            {{ $consultingBooking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultingBooking.fields.consulting') }}
                        </th>
                        <td>
                            {{ $consultingBooking->consulting->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultingBooking.fields.user') }}
                        </th>
                        <td>
                            {{ $consultingBooking->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultingBooking.fields.meeting_link') }}
                        </th>
                        <td>
                            {{ $consultingBooking->meeting_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultingBooking.fields.meeting_date') }}
                        </th>
                        <td>
                            {{ $consultingBooking->meeting_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.consulting-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
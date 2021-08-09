@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.seminar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seminars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.seminar.fields.id') }}
                        </th>
                        <td>
                            {{ $seminar->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seminar.fields.title') }}
                        </th>
                        <td>
                            {{ $seminar->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seminar.fields.description') }}
                        </th>
                        <td>
                            {{ $seminar->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seminar.fields.pdf') }}
                        </th>
                        <td>
                            @if($seminar->pdf)
                                <a href="{{ $seminar->pdf->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seminar.fields.date') }}
                        </th>
                        <td>
                            {{ $seminar->date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seminars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.blogsManagment.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.blogs-managments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogsManagment.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $blogsManagment->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogsManagment.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $blogsManagment->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogsManagment.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $blogsManagment->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogsManagment.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\BlogsManagment::STATUS_RADIO[$blogsManagment->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogsManagment.fields.reason') }}
                                    </th>
                                    <td>
                                        {{ $blogsManagment->reason }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogsManagment.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $blogsManagment->user->email ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.blogs-managments.index') }}">
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
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.refugeesLegalService.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.refugees-legal-services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.refugeesLegalService.fields.id') }}
                        </th>
                        <td>
                            {{ $refugeesLegalService->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.refugeesLegalService.fields.title') }}
                        </th>
                        <td>
                            {{ $refugeesLegalService->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.refugees-legal-services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
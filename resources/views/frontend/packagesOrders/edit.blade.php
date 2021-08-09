@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.packagesOrder.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.packages-orders.update", [$packagesOrder->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.packagesOrder.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $packagesOrder->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.packagesOrder.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="package_id">{{ trans('cruds.packagesOrder.fields.package') }}</label>
                            <select class="form-control select2" name="package_id" id="package_id" required>
                                @foreach($packages as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('package_id') ? old('package_id') : $packagesOrder->package->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('package'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('package') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.packagesOrder.fields.package_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
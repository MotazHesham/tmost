@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.seminarsSubscription.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.seminars-subscriptions.update", [$seminarsSubscription->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="first_name">{{ trans('cruds.seminarsSubscription.fields.first_name') }}</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" value="{{ old('first_name', $seminarsSubscription->first_name) }}" required>
                            @if($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminarsSubscription.fields.first_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="last_name">{{ trans('cruds.seminarsSubscription.fields.last_name') }}</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="{{ old('last_name', $seminarsSubscription->last_name) }}" required>
                            @if($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminarsSubscription.fields.last_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.seminarsSubscription.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $seminarsSubscription->email) }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminarsSubscription.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="company">{{ trans('cruds.seminarsSubscription.fields.company') }}</label>
                            <input class="form-control" type="text" name="company" id="company" value="{{ old('company', $seminarsSubscription->company) }}" required>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminarsSubscription.fields.company_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="position">{{ trans('cruds.seminarsSubscription.fields.position') }}</label>
                            <input class="form-control" type="text" name="position" id="position" value="{{ old('position', $seminarsSubscription->position) }}" required>
                            @if($errors->has('position'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('position') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminarsSubscription.fields.position_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="seminar_id">{{ trans('cruds.seminarsSubscription.fields.seminar') }}</label>
                            <select class="form-control select2" name="seminar_id" id="seminar_id" required>
                                @foreach($seminars as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('seminar_id') ? old('seminar_id') : $seminarsSubscription->seminar->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('seminar'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seminar') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminarsSubscription.fields.seminar_helper') }}</span>
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
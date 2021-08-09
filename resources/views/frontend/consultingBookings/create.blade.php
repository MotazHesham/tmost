@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.consultingBooking.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.consulting-bookings.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="consulting_id">{{ trans('cruds.consultingBooking.fields.consulting') }}</label>
                            <select class="form-control select2" name="consulting_id" id="consulting_id" required>
                                @foreach($consultings as $id => $entry)
                                    <option value="{{ $id }}" {{ old('consulting_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('consulting'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('consulting') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.consultingBooking.fields.consulting_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.consultingBooking.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.consultingBooking.fields.user_helper') }}</span>
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
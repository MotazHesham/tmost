@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.consultingBooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.consulting-bookings.update", [$consultingBooking->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="consulting_id">{{ trans('cruds.consultingBooking.fields.consulting') }}</label>
                <select class="form-control select2 {{ $errors->has('consulting') ? 'is-invalid' : '' }}" name="consulting_id" id="consulting_id" required>
                    @foreach($consultings as $id => $entry)
                        <option value="{{ $id }}" {{ (old('consulting_id') ? old('consulting_id') : $consultingBooking->consulting->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $consultingBooking->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label for="meeting_link">{{ trans('cruds.consultingBooking.fields.meeting_link') }}</label>
                <input class="form-control {{ $errors->has('meeting_link') ? 'is-invalid' : '' }}" type="text" name="meeting_link" id="meeting_link" value="{{ old('meeting_link', $consultingBooking->meeting_link) }}">
                @if($errors->has('meeting_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.consultingBooking.fields.meeting_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="meeting_date">{{ trans('cruds.consultingBooking.fields.meeting_date') }}</label>
                <input class="form-control datetime {{ $errors->has('meeting_date') ? 'is-invalid' : '' }}" type="text" name="meeting_date" id="meeting_date" value="{{ old('meeting_date', $consultingBooking->meeting_date) }}">
                @if($errors->has('meeting_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.consultingBooking.fields.meeting_date_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.package.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.packages.update", [$package->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.package.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $package->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="description">{{ trans('cruds.package.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description" required>{{ old('description', $package->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="price">{{ trans('cruds.package.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', $package->price) }}" step="0.01" required>
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="images">{{ trans('cruds.package.fields.images') }}</label>
                            <div class="needsclick dropzone" id="images-dropzone">
                            </div>
                            @if($errors->has('images'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('images') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.images_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="books">{{ trans('cruds.package.fields.books') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="books[]" id="books" multiple required>
                                @foreach($books as $id => $book)
                                    <option value="{{ $id }}" {{ (in_array($id, old('books', [])) || $package->books->contains($id)) ? 'selected' : '' }}>{{ $book }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('books'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('books') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.books_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="videos">{{ trans('cruds.package.fields.videos') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="videos[]" id="videos" multiple required>
                                @foreach($videos as $id => $video)
                                    <option value="{{ $id }}" {{ (in_array($id, old('videos', [])) || $package->videos->contains($id)) ? 'selected' : '' }}>{{ $video }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('videos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('videos') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.videos_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{ route('frontend.packages.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
      uploadedImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImagesMap[file.name]
      }
      $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($package) && $package->images)
      var files = {!! json_encode($package->images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
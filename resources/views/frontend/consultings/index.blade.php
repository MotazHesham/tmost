@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('consulting_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.consultings.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.consulting.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.consulting.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Consulting">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.consulting.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consulting.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consulting.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consulting.fields.price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consulting.fields.image') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($consultings as $key => $consulting)
                                    <tr data-entry-id="{{ $consulting->id }}">
                                        <td>
                                            {{ $consulting->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $consulting->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $consulting->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $consulting->price ?? '' }}
                                        </td>
                                        <td>
                                            @if($consulting->image)
                                                <a href="{{ $consulting->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $consulting->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('consulting_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.consultings.show', $consulting->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('consulting_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.consultings.edit', $consulting->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('consulting_delete')
                                                <form action="{{ route('frontend.consultings.destroy', $consulting->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('consulting_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.consultings.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Consulting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
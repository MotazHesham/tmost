@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('quote_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.quotes.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.quote.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.quote.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Quote">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.quote.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quote.fields.first_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quote.fields.last_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quote.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quote.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quote.fields.message') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quotes as $key => $quote)
                                    <tr data-entry-id="{{ $quote->id }}">
                                        <td>
                                            {{ $quote->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quote->first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quote->last_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quote->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quote->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quote->message ?? '' }}
                                        </td>
                                        <td>
                                            @can('quote_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.quotes.show', $quote->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('quote_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.quotes.edit', $quote->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('quote_delete')
                                                <form action="{{ route('frontend.quotes.destroy', $quote->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('quote_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.quotes.massDestroy') }}",
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
    pageLength: 10,
  });
  let table = $('.datatable-Quote:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
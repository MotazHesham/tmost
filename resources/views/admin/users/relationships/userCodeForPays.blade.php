@can('code_for_pay_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.code-for-pays.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.codeForPay.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.codeForPay.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userCodeForPays">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.codeForPay.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.codeForPay.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.codeForPay.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.codeForPay.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.codeForPay.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($codeForPays as $key => $codeForPay)
                        <tr data-entry-id="{{ $codeForPay->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $codeForPay->id ?? '' }}
                            </td>
                            <td>
                                {{ $codeForPay->code ?? '' }}
                            </td>
                            <td>
                                {{ $codeForPay->description ?? '' }}
                            </td>
                            <td>
                                {{ $codeForPay->price ?? '' }}
                            </td>
                            <td>
                                {{ $codeForPay->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $codeForPay->user->email ?? '' }}
                            </td>
                            <td>
                                @can('code_for_pay_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.code-for-pays.show', $codeForPay->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('code_for_pay_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.code-for-pays.edit', $codeForPay->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('code_for_pay_delete')
                                    <form action="{{ route('admin.code-for-pays.destroy', $codeForPay->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('code_for_pay_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.code-for-pays.massDestroy') }}",
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
  let table = $('.datatable-userCodeForPays:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
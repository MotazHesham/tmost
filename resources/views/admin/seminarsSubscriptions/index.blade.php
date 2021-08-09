@extends('layouts.admin')
@section('content')
@can('seminars_subscription_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.seminars-subscriptions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.seminarsSubscription.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.seminarsSubscription.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SeminarsSubscription">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.position') }}
                        </th>
                        <th>
                            {{ trans('cruds.seminarsSubscription.fields.seminar') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seminarsSubscriptions as $key => $seminarsSubscription)
                        <tr data-entry-id="{{ $seminarsSubscription->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $seminarsSubscription->id ?? '' }}
                            </td>
                            <td>
                                {{ $seminarsSubscription->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $seminarsSubscription->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $seminarsSubscription->email ?? '' }}
                            </td>
                            <td>
                                {{ $seminarsSubscription->company ?? '' }}
                            </td>
                            <td>
                                {{ $seminarsSubscription->position ?? '' }}
                            </td>
                            <td>
                                {{ $seminarsSubscription->seminar->title ?? '' }}
                            </td>
                            <td>
                                @can('seminars_subscription_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.seminars-subscriptions.show', $seminarsSubscription->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('seminars_subscription_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.seminars-subscriptions.edit', $seminarsSubscription->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('seminars_subscription_delete')
                                    <form action="{{ route('admin.seminars-subscriptions.destroy', $seminarsSubscription->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('seminars_subscription_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.seminars-subscriptions.massDestroy') }}",
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
  let table = $('.datatable-SeminarsSubscription:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
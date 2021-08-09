@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('blogs_managment_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.blogs-managments.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.blogsManagment.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.blogsManagment.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BlogsManagment">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogsManagment.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blogsManagment.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blogsManagment.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blogsManagment.fields.reason') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blogsManagment.fields.user') }}
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
                                @foreach($blogsManagments as $key => $blogsManagment)
                                    <tr data-entry-id="{{ $blogsManagment->id }}">
                                        <td>
                                            {{ $blogsManagment->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $blogsManagment->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\BlogsManagment::STATUS_RADIO[$blogsManagment->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $blogsManagment->reason ?? '' }}
                                        </td>
                                        <td>
                                            {{ $blogsManagment->user->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $blogsManagment->user->email ?? '' }}
                                        </td>
                                        <td>
                                            @can('blogs_managment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.blogs-managments.show', $blogsManagment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('blogs_managment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.blogs-managments.edit', $blogsManagment->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('blogs_managment_delete')
                                                <form action="{{ route('frontend.blogs-managments.destroy', $blogsManagment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('blogs_managment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.blogs-managments.massDestroy') }}",
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
  let table = $('.datatable-BlogsManagment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
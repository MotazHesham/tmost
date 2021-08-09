@extends('layouts.admin')
@section('content')
@can('real_estate_registration_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.real-estate-registrations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.realEstateRegistration.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.realEstateRegistration.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-RealEstateRegistration">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstateRegistration.fields.comment') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($realEstateRegistrations as $key => $realEstateRegistration)
                        <tr data-entry-id="{{ $realEstateRegistration->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $realEstateRegistration->id ?? '' }}
                            </td>
                            <td>
                                {{ $realEstateRegistration->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $realEstateRegistration->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $realEstateRegistration->email ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\RealEstateRegistration::TYPE_SELECT[$realEstateRegistration->type] ?? '' }}
                            </td>
                            <td>
                                {{ $realEstateRegistration->code ?? '' }}
                            </td>
                            <td>
                                {{ $realEstateRegistration->comment ?? '' }}
                            </td>
                            <td>
                                @can('real_estate_registration_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.real-estate-registrations.show', $realEstateRegistration->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('real_estate_registration_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.real-estate-registrations.edit', $realEstateRegistration->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('real_estate_registration_delete')
                                    <form action="{{ route('admin.real-estate-registrations.destroy', $realEstateRegistration->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('real_estate_registration_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.real-estate-registrations.massDestroy') }}",
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
  let table = $('.datatable-RealEstateRegistration:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
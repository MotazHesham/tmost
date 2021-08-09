@extends('layouts.admin')
@section('content')
@can('refugees_lega_registration_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.refugees-lega-registrations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.refugeesLegaRegistration.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.refugeesLegaRegistration.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-RefugeesLegaRegistration">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.refugeesLegaRegistration.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.refugeesLegaRegistration.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.refugeesLegaRegistration.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.refugeesLegaRegistration.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.refugeesLegaRegistration.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.refugeesLegaRegistration.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.refugeesLegaRegistration.fields.company') }}
                    </th>
                    <th>
                        {{ trans('cruds.refugeesLegaRegistration.fields.position') }}
                    </th>
                    <th>
                        {{ trans('cruds.refugeesLegaRegistration.fields.service') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('refugees_lega_registration_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.refugees-lega-registrations.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.refugees-lega-registrations.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'first_name', name: 'first_name' },
{ data: 'last_name', name: 'last_name' },
{ data: 'email', name: 'email' },
{ data: 'phone', name: 'phone' },
{ data: 'address', name: 'address' },
{ data: 'company', name: 'company' },
{ data: 'position', name: 'position' },
{ data: 'service_title', name: 'service.title' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-RefugeesLegaRegistration').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection
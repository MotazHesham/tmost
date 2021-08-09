@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.setting.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Setting">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.setting.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.setting.fields.site_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.setting.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.setting.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.setting.fields.logo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.setting.fields.facebook') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.setting.fields.twitter') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.setting.fields.linkedin') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $key => $setting)
                                    <tr data-entry-id="{{ $setting->id }}">
                                        <td>
                                            {{ $setting->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $setting->site_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $setting->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $setting->address ?? '' }}
                                        </td>
                                        <td>
                                            @if($setting->logo)
                                                <a href="{{ $setting->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $setting->logo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $setting->facebook ?? '' }}
                                        </td>
                                        <td>
                                            {{ $setting->twitter ?? '' }}
                                        </td>
                                        <td>
                                            {{ $setting->linkedin ?? '' }}
                                        </td>
                                        <td>

                                            @can('setting_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.settings.edit', $setting->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
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
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Setting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
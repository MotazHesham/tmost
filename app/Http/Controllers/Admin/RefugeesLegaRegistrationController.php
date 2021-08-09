<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRefugeesLegaRegistrationRequest;
use App\Http\Requests\StoreRefugeesLegaRegistrationRequest;
use App\Http\Requests\UpdateRefugeesLegaRegistrationRequest;
use App\Models\RefugeesLegalService;
use App\Models\RefugeesLegaRegistration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RefugeesLegaRegistrationController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('refugees_lega_registration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RefugeesLegaRegistration::with(['service'])->select(sprintf('%s.*', (new RefugeesLegaRegistration())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'refugees_lega_registration_show';
                $editGate = 'refugees_lega_registration_edit';
                $deleteGate = 'refugees_lega_registration_delete';
                $crudRoutePart = 'refugees-lega-registrations';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('company', function ($row) {
                return $row->company ? $row->company : '';
            });
            $table->editColumn('position', function ($row) {
                return $row->position ? $row->position : '';
            });
            $table->addColumn('service_title', function ($row) {
                return $row->service ? $row->service->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'service']);

            return $table->make(true);
        }

        return view('admin.refugeesLegaRegistrations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('refugees_lega_registration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = RefugeesLegalService::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.refugeesLegaRegistrations.create', compact('services'));
    }

    public function store(StoreRefugeesLegaRegistrationRequest $request)
    {
        $refugeesLegaRegistration = RefugeesLegaRegistration::create($request->all());

        return redirect()->route('admin.refugees-lega-registrations.index');
    }

    public function edit(RefugeesLegaRegistration $refugeesLegaRegistration)
    {
        abort_if(Gate::denies('refugees_lega_registration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = RefugeesLegalService::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $refugeesLegaRegistration->load('service');

        return view('admin.refugeesLegaRegistrations.edit', compact('services', 'refugeesLegaRegistration'));
    }

    public function update(UpdateRefugeesLegaRegistrationRequest $request, RefugeesLegaRegistration $refugeesLegaRegistration)
    {
        $refugeesLegaRegistration->update($request->all());

        return redirect()->route('admin.refugees-lega-registrations.index');
    }

    public function show(RefugeesLegaRegistration $refugeesLegaRegistration)
    {
        abort_if(Gate::denies('refugees_lega_registration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refugeesLegaRegistration->load('service');

        return view('admin.refugeesLegaRegistrations.show', compact('refugeesLegaRegistration'));
    }

    public function destroy(RefugeesLegaRegistration $refugeesLegaRegistration)
    {
        abort_if(Gate::denies('refugees_lega_registration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refugeesLegaRegistration->delete();

        return back();
    }

    public function massDestroy(MassDestroyRefugeesLegaRegistrationRequest $request)
    {
        RefugeesLegaRegistration::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

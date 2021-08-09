<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRefugeesLegaRegistrationRequest;
use App\Http\Requests\StoreRefugeesLegaRegistrationRequest;
use App\Http\Requests\UpdateRefugeesLegaRegistrationRequest;
use App\Models\RefugeesLegalService;
use App\Models\RefugeesLegaRegistration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefugeesLegaRegistrationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('refugees_lega_registration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refugeesLegaRegistrations = RefugeesLegaRegistration::with(['service'])->get();

        return view('frontend.refugeesLegaRegistrations.index', compact('refugeesLegaRegistrations'));
    }

    public function create()
    {
        abort_if(Gate::denies('refugees_lega_registration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = RefugeesLegalService::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.refugeesLegaRegistrations.create', compact('services'));
    }

    public function store(StoreRefugeesLegaRegistrationRequest $request)
    {
        $refugeesLegaRegistration = RefugeesLegaRegistration::create($request->all());

        return redirect()->route('frontend.refugees-lega-registrations.index');
    }

    public function edit(RefugeesLegaRegistration $refugeesLegaRegistration)
    {
        abort_if(Gate::denies('refugees_lega_registration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = RefugeesLegalService::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $refugeesLegaRegistration->load('service');

        return view('frontend.refugeesLegaRegistrations.edit', compact('services', 'refugeesLegaRegistration'));
    }

    public function update(UpdateRefugeesLegaRegistrationRequest $request, RefugeesLegaRegistration $refugeesLegaRegistration)
    {
        $refugeesLegaRegistration->update($request->all());

        return redirect()->route('frontend.refugees-lega-registrations.index');
    }

    public function show(RefugeesLegaRegistration $refugeesLegaRegistration)
    {
        abort_if(Gate::denies('refugees_lega_registration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refugeesLegaRegistration->load('service');

        return view('frontend.refugeesLegaRegistrations.show', compact('refugeesLegaRegistration'));
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

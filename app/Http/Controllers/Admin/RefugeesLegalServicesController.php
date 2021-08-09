<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRefugeesLegalServiceRequest;
use App\Http\Requests\StoreRefugeesLegalServiceRequest;
use App\Http\Requests\UpdateRefugeesLegalServiceRequest;
use App\Models\RefugeesLegalService;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefugeesLegalServicesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('refugees_legal_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refugeesLegalServices = RefugeesLegalService::all();

        return view('admin.refugeesLegalServices.index', compact('refugeesLegalServices'));
    }

    public function create()
    {
        abort_if(Gate::denies('refugees_legal_service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.refugeesLegalServices.create');
    }

    public function store(StoreRefugeesLegalServiceRequest $request)
    {
        $refugeesLegalService = RefugeesLegalService::create($request->all());

        return redirect()->route('admin.refugees-legal-services.index');
    }

    public function edit(RefugeesLegalService $refugeesLegalService)
    {
        abort_if(Gate::denies('refugees_legal_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.refugeesLegalServices.edit', compact('refugeesLegalService'));
    }

    public function update(UpdateRefugeesLegalServiceRequest $request, RefugeesLegalService $refugeesLegalService)
    {
        $refugeesLegalService->update($request->all());

        return redirect()->route('admin.refugees-legal-services.index');
    }

    public function show(RefugeesLegalService $refugeesLegalService)
    {
        abort_if(Gate::denies('refugees_legal_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.refugeesLegalServices.show', compact('refugeesLegalService'));
    }

    public function destroy(RefugeesLegalService $refugeesLegalService)
    {
        abort_if(Gate::denies('refugees_legal_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refugeesLegalService->delete();

        return back();
    }

    public function massDestroy(MassDestroyRefugeesLegalServiceRequest $request)
    {
        RefugeesLegalService::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

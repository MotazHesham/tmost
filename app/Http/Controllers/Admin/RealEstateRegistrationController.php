<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRealEstateRegistrationRequest;
use App\Http\Requests\StoreRealEstateRegistrationRequest;
use App\Http\Requests\UpdateRealEstateRegistrationRequest;
use App\Models\RealEstateRegistration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RealEstateRegistrationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('real_estate_registration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstateRegistrations = RealEstateRegistration::all();

        return view('admin.realEstateRegistrations.index', compact('realEstateRegistrations'));
    }

    public function create()
    {
        abort_if(Gate::denies('real_estate_registration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.realEstateRegistrations.create');
    }

    public function store(StoreRealEstateRegistrationRequest $request)
    {
        $realEstateRegistration = RealEstateRegistration::create($request->all());

        return redirect()->route('admin.real-estate-registrations.index');
    }

    public function edit(RealEstateRegistration $realEstateRegistration)
    {
        abort_if(Gate::denies('real_estate_registration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.realEstateRegistrations.edit', compact('realEstateRegistration'));
    }

    public function update(UpdateRealEstateRegistrationRequest $request, RealEstateRegistration $realEstateRegistration)
    {
        $realEstateRegistration->update($request->all());

        return redirect()->route('admin.real-estate-registrations.index');
    }

    public function show(RealEstateRegistration $realEstateRegistration)
    {
        abort_if(Gate::denies('real_estate_registration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.realEstateRegistrations.show', compact('realEstateRegistration'));
    }

    public function destroy(RealEstateRegistration $realEstateRegistration)
    {
        abort_if(Gate::denies('real_estate_registration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstateRegistration->delete();

        return back();
    }

    public function massDestroy(MassDestroyRealEstateRegistrationRequest $request)
    {
        RealEstateRegistration::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

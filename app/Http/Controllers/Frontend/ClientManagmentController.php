<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientManagmentRequest;
use App\Http\Requests\StoreClientManagmentRequest;
use App\Http\Requests\UpdateClientManagmentRequest;
use App\Models\ClientManagment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientManagmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('client_managment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientManagments = ClientManagment::all();

        return view('frontend.clientManagments.index', compact('clientManagments'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_managment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.clientManagments.create');
    }

    public function store(StoreClientManagmentRequest $request)
    {
        $clientManagment = ClientManagment::create($request->all());

        return redirect()->route('frontend.client-managments.index');
    }

    public function edit(ClientManagment $clientManagment)
    {
        abort_if(Gate::denies('client_managment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.clientManagments.edit', compact('clientManagment'));
    }

    public function update(UpdateClientManagmentRequest $request, ClientManagment $clientManagment)
    {
        $clientManagment->update($request->all());

        return redirect()->route('frontend.client-managments.index');
    }

    public function show(ClientManagment $clientManagment)
    {
        abort_if(Gate::denies('client_managment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.clientManagments.show', compact('clientManagment'));
    }

    public function destroy(ClientManagment $clientManagment)
    {
        abort_if(Gate::denies('client_managment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientManagment->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientManagmentRequest $request)
    {
        ClientManagment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

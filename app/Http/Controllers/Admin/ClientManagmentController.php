<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientManagmentRequest;
use App\Http\Requests\StoreClientManagmentRequest;
use App\Http\Requests\UpdateClientManagmentRequest;
use App\Models\ClientManagment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientManagmentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_managment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientManagment::query()->select(sprintf('%s.*', (new ClientManagment())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'client_managment_show';
                $editGate = 'client_managment_edit';
                $deleteGate = 'client_managment_delete';
                $crudRoutePart = 'client-managments';

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
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('comany', function ($row) {
                return $row->comany ? $row->comany : '';
            });
            $table->editColumn('position', function ($row) {
                return $row->position ? $row->position : '';
            });
            $table->editColumn('service', function ($row) {
                return $row->service ? ClientManagment::SERVICE_SELECT[$row->service] : '';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.clientManagments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_managment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clientManagments.create');
    }

    public function store(StoreClientManagmentRequest $request)
    {
        $clientManagment = ClientManagment::create($request->all());

        return redirect()->route('admin.client-managments.index');
    }

    public function edit(ClientManagment $clientManagment)
    {
        abort_if(Gate::denies('client_managment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clientManagments.edit', compact('clientManagment'));
    }

    public function update(UpdateClientManagmentRequest $request, ClientManagment $clientManagment)
    {
        $clientManagment->update($request->all());

        return redirect()->route('admin.client-managments.index');
    }

    public function show(ClientManagment $clientManagment)
    {
        abort_if(Gate::denies('client_managment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clientManagments.show', compact('clientManagment'));
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

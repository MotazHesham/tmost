<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPackagesOrderRequest;
use App\Http\Requests\StorePackagesOrderRequest;
use App\Http\Requests\UpdatePackagesOrderRequest;
use App\Models\Package;
use App\Models\PackagesOrder;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PackagesOrdersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('packages_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PackagesOrder::with(['user', 'package'])->select(sprintf('%s.*', (new PackagesOrder())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'packages_order_show';
                $editGate = 'packages_order_edit';
                $deleteGate = 'packages_order_delete';
                $crudRoutePart = 'packages-orders';

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
            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });

            $table->addColumn('package_title', function ($row) {
                return $row->package ? $row->package->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'package']);

            return $table->make(true);
        }

        return view('admin.packagesOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('packages_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.packagesOrders.create', compact('users', 'packages'));
    }

    public function store(StorePackagesOrderRequest $request)
    {
        $packagesOrder = PackagesOrder::create($request->all());

        return redirect()->route('admin.packages-orders.index');
    }

    public function edit(PackagesOrder $packagesOrder)
    {
        abort_if(Gate::denies('packages_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packagesOrder->load('user', 'package');

        return view('admin.packagesOrders.edit', compact('users', 'packages', 'packagesOrder'));
    }

    public function update(UpdatePackagesOrderRequest $request, PackagesOrder $packagesOrder)
    {
        $packagesOrder->update($request->all());

        return redirect()->route('admin.packages-orders.index');
    }

    public function show(PackagesOrder $packagesOrder)
    {
        abort_if(Gate::denies('packages_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packagesOrder->load('user', 'package');

        return view('admin.packagesOrders.show', compact('packagesOrder'));
    }

    public function destroy(PackagesOrder $packagesOrder)
    {
        abort_if(Gate::denies('packages_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packagesOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroyPackagesOrderRequest $request)
    {
        PackagesOrder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

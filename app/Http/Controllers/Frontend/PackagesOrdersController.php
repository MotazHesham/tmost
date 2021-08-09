<?php

namespace App\Http\Controllers\Frontend;

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

class PackagesOrdersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('packages_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packagesOrders = PackagesOrder::with(['user', 'package'])->get();

        return view('frontend.packagesOrders.index', compact('packagesOrders'));
    }

    public function create()
    {
        abort_if(Gate::denies('packages_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.packagesOrders.create', compact('users', 'packages'));
    }

    public function store(StorePackagesOrderRequest $request)
    {
        $packagesOrder = PackagesOrder::create($request->all());

        return redirect()->route('frontend.packages-orders.index');
    }

    public function edit(PackagesOrder $packagesOrder)
    {
        abort_if(Gate::denies('packages_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packagesOrder->load('user', 'package');

        return view('frontend.packagesOrders.edit', compact('users', 'packages', 'packagesOrder'));
    }

    public function update(UpdatePackagesOrderRequest $request, PackagesOrder $packagesOrder)
    {
        $packagesOrder->update($request->all());

        return redirect()->route('frontend.packages-orders.index');
    }

    public function show(PackagesOrder $packagesOrder)
    {
        abort_if(Gate::denies('packages_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packagesOrder->load('user', 'package');

        return view('frontend.packagesOrders.show', compact('packagesOrder'));
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

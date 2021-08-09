<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySeminarsSubscriptionRequest;
use App\Http\Requests\StoreSeminarsSubscriptionRequest;
use App\Http\Requests\UpdateSeminarsSubscriptionRequest;
use App\Models\Seminar;
use App\Models\SeminarsSubscription;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SeminarsSubscriptionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('seminars_subscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seminarsSubscriptions = SeminarsSubscription::with(['seminar'])->get();

        return view('frontend.seminarsSubscriptions.index', compact('seminarsSubscriptions'));
    }

    public function create()
    {
        abort_if(Gate::denies('seminars_subscription_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seminars = Seminar::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.seminarsSubscriptions.create', compact('seminars'));
    }

    public function store(StoreSeminarsSubscriptionRequest $request)
    {
        $seminarsSubscription = SeminarsSubscription::create($request->all());

        return redirect()->route('frontend.seminars-subscriptions.index');
    }

    public function edit(SeminarsSubscription $seminarsSubscription)
    {
        abort_if(Gate::denies('seminars_subscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seminars = Seminar::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $seminarsSubscription->load('seminar');

        return view('frontend.seminarsSubscriptions.edit', compact('seminars', 'seminarsSubscription'));
    }

    public function update(UpdateSeminarsSubscriptionRequest $request, SeminarsSubscription $seminarsSubscription)
    {
        $seminarsSubscription->update($request->all());

        return redirect()->route('frontend.seminars-subscriptions.index');
    }

    public function show(SeminarsSubscription $seminarsSubscription)
    {
        abort_if(Gate::denies('seminars_subscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seminarsSubscription->load('seminar');

        return view('frontend.seminarsSubscriptions.show', compact('seminarsSubscription'));
    }

    public function destroy(SeminarsSubscription $seminarsSubscription)
    {
        abort_if(Gate::denies('seminars_subscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seminarsSubscription->delete();

        return back();
    }

    public function massDestroy(MassDestroySeminarsSubscriptionRequest $request)
    {
        SeminarsSubscription::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

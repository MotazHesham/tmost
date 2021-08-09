<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyConsultingBookingRequest;
use App\Http\Requests\StoreConsultingBookingRequest;
use App\Http\Requests\UpdateConsultingBookingRequest;
use App\Models\Consulting;
use App\Models\ConsultingBooking;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsultingBookingsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('consulting_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultingBookings = ConsultingBooking::with(['consulting', 'user'])->get();

        return view('frontend.consultingBookings.index', compact('consultingBookings'));
    }

    public function create()
    {
        abort_if(Gate::denies('consulting_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultings = Consulting::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.consultingBookings.create', compact('consultings', 'users'));
    }

    public function store(StoreConsultingBookingRequest $request)
    {
        $consultingBooking = ConsultingBooking::create($request->all());

        return redirect()->route('frontend.consulting-bookings.index');
    }

    public function edit(ConsultingBooking $consultingBooking)
    {
        abort_if(Gate::denies('consulting_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultings = Consulting::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $consultingBooking->load('consulting', 'user');

        return view('frontend.consultingBookings.edit', compact('consultings', 'users', 'consultingBooking'));
    }

    public function update(UpdateConsultingBookingRequest $request, ConsultingBooking $consultingBooking)
    {
        $consultingBooking->update($request->all());

        return redirect()->route('frontend.consulting-bookings.index');
    }

    public function show(ConsultingBooking $consultingBooking)
    {
        abort_if(Gate::denies('consulting_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultingBooking->load('consulting', 'user');

        return view('frontend.consultingBookings.show', compact('consultingBooking'));
    }

    public function destroy(ConsultingBooking $consultingBooking)
    {
        abort_if(Gate::denies('consulting_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultingBooking->delete();

        return back();
    }

    public function massDestroy(MassDestroyConsultingBookingRequest $request)
    {
        ConsultingBooking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

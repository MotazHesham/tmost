<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class ConsultingBookingsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('consulting_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ConsultingBooking::with(['consulting', 'user'])->select(sprintf('%s.*', (new ConsultingBooking())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'consulting_booking_show';
                $editGate = 'consulting_booking_edit';
                $deleteGate = 'consulting_booking_delete';
                $crudRoutePart = 'consulting-bookings';

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
            $table->addColumn('consulting_title', function ($row) {
                return $row->consulting ? $row->consulting->title : '';
            });

            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });

            $table->editColumn('meeting_link', function ($row) {
                return $row->meeting_link ? $row->meeting_link : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'consulting', 'user']);

            return $table->make(true);
        }

        return view('admin.consultingBookings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('consulting_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultings = Consulting::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.consultingBookings.create', compact('consultings', 'users'));
    }

    public function store(StoreConsultingBookingRequest $request)
    {
        $consultingBooking = ConsultingBooking::create($request->all());

        return redirect()->route('admin.consulting-bookings.index');
    }

    public function edit(ConsultingBooking $consultingBooking)
    {
        abort_if(Gate::denies('consulting_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultings = Consulting::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $consultingBooking->load('consulting', 'user');

        return view('admin.consultingBookings.edit', compact('consultings', 'users', 'consultingBooking'));
    }

    public function update(UpdateConsultingBookingRequest $request, ConsultingBooking $consultingBooking)
    {
        $consultingBooking->update($request->all());

        return redirect()->route('admin.consulting-bookings.index');
    }

    public function show(ConsultingBooking $consultingBooking)
    {
        abort_if(Gate::denies('consulting_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultingBooking->load('consulting', 'user');

        return view('admin.consultingBookings.show', compact('consultingBooking'));
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

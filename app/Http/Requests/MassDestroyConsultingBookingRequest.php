<?php

namespace App\Http\Requests;

use App\Models\ConsultingBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyConsultingBookingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('consulting_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:consulting_bookings,id',
        ];
    }
}

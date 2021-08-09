<?php

namespace App\Http\Requests;

use App\Models\ConsultingBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateConsultingBookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('consulting_booking_edit');
    }

    public function rules()
    {
        return [
            'consulting_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'meeting_link' => [
                'string',
                'nullable',
            ],
            'meeting_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}

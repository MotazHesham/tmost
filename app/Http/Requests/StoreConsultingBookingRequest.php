<?php

namespace App\Http\Requests;

use App\Models\ConsultingBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreConsultingBookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('consulting_booking_create');
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
        ];
    }
}

<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultingBooking extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'consulting_bookings';

    protected $dates = [
        'meeting_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'consulting_id',
        'user_id',
        'meeting_link',
        'meeting_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function consulting()
    {
        return $this->belongsTo(Consulting::class, 'consulting_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getMeetingDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setMeetingDateAttribute($value)
    {
        $this->attributes['meeting_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RealEstateRegistration extends Model
{
    use SoftDeletes;

    public const TYPE_SELECT = [
        'individual' => 'Individual',
        'corporate'  => 'Corporate',
        'compound'   => 'Compound',
    ];

    public $table = 'real_estate_registrations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'type',
        'code',
        'comment',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

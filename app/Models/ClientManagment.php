<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientManagment extends Model
{
    use SoftDeletes;
    use Auditable;

    public const SERVICE_SELECT = [
        'real_estate'             => 'Real Estate Registeration',
        'corporate_legal_service' => 'Corporate Legal Services',
        'hr_service'              => 'HR Services',
        'consulting'              => 'Consulting',
    ];

    public $table = 'client_managments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'comany',
        'position',
        'service',
        'code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

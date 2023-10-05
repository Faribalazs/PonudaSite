<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Company_Data extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'company_data';
    
    public $timestamps = false;

    protected $fillable = [
        'worker_id',
        'company_name',
        'country',
        'city',
        'zip_code',
        'address',
        'tel',
        'email',
        'phone',
        'pib',
        'maticni_broj',
        'tekuci_racun',
        'bank_account',
        'bank_name',
        'logo',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected static $logName = 'company';

    // protected static $logAttributes = ['name', 'password'];

    protected static $logOnlyDirty = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_Data extends Model
{
    use HasFactory;

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
}

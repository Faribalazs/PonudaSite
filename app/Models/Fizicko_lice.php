<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fizicko_lice extends Model
{
    use HasFactory;
    
    protected $table = 'fizicka_lica';

    public $timestamps = false;

    protected $fillable = [
        'worker_id',
        'first_name',
        'last_name',
        'city',
        'zip_code',
        'address',
        'email',
        'phone',
    ];
}

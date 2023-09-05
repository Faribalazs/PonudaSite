<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponuda_Date extends Model
{
    use HasFactory;

    protected $table = 'ponuda_date';

    const UPDATED_AT = null;
    const CREATED_AT = null;
    public $timestamps = false;

    protected $fillable = [
        'worker_id',
        'id_ponuda',
        'ponuda_name',
        'note',
        'opis',
    ];
}

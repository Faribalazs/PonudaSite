<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponuda_Date extends Model
{
    use HasFactory;

    protected $table = 'ponuda_date';

    public $timestamps = true;

    protected $fillable = [
        'worker_id',
        'id_ponuda',
        'ponuda_name',
        'note',
        'opis',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->updated_at = null;
        });
    }
}

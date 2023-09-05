<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Default_pozicija extends Model
{
    use HasFactory;

    protected $table = 'pozicija';

    public $timestamps = false;

    protected $fillable = [
        'subcategory_id',
        'unit_id',
        'title',
        'description',
    ];
}

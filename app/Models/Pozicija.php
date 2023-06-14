<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pozicija extends Model
{
    use HasFactory;

    protected $table = 'custom_pozicija';

    public $timestamps = false;
    
    protected $fillable = [
        'custom_subcategory_id',
        'unit_id',
        'title',
        'description',
    ];
}

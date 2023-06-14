<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponuda extends Model
{
    use HasFactory;

    protected $table = 'ponuda';

    public $timestamps = false;
    
    protected $fillable = [
        'worker_id',
        'ponuda_id',
        'categories_id',
        'subcategories_id',
        'pozicija_id',
        'quantity',
        'unit_price',
        'overall_price',
    ];
}

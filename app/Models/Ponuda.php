<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Ponuda extends Model
{
    use HasFactory, HasTranslations;

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

    public $translatable = ['title', 'description','name_category'];

}

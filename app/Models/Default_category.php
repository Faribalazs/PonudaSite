<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Default_category extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'categories';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public $translatable = ['name'];
}

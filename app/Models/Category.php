<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'custom_categories';

    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'worker_id',
    ];
}

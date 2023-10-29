<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'custom_subcategories';

    public $timestamps = false;
    
    protected $fillable = [
        'worker_id',
        'custom_category_id',
        'name',
    ];
}

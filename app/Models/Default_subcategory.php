<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Default_subcategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    public $timestamps = false;
}

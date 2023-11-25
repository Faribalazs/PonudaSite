<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Pozicija extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'custom_pozicija';

    public $timestamps = false;
    
    protected $fillable = [
        'worker_id',
        'custom_subcategory_id',
        'unit_id',
        'custom_title',
        'custom_description',
    ];

    public $translatable = ['custom_title','custom_description'];

    public function unit()
    {
        return $this->belongsTo(Units::class, 'unit_id', 'id_unit');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use HasFactory;

    public $attributes = [ 'hits' => 0 ];

    protected $fillable = [ 'ip', 'worker_id', 'date' ];

    public $timestamps = false;

    protected $table = 'worker_tracker';

    public static function boot() {
        // When a new instance of this model is created...
        parent::boot();
        static::creating(function ($tracker) {
            $tracker->hits = 0;
        } );
        // Any time the instance is updated (but not created)
        static::saving(function ($tracker) {
            $tracker->visit_date = date('Y-m-d');
            $tracker->visit_time = date('H:i:s');
            $tracker->hits++;
        } );
    }

    public static function hit() {
        try {
            static::firstOrCreate([
                'ip' => request()->ip() ?? 'no-ip',
                'worker_id' => auth('worker')->user()->id,
                'visit_date' => date('Y-m-d'),
            ])->save();
        } catch (\Exception) {
            //should be empty
        }
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id')->select('name');
    }
}

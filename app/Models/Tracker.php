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

    // // Fill in the IP and today's date
    // public function scopeCurrent($query) {
    //     return $query->where('ip', $_SERVER['REMOTE_ADDR'])
    //                  ->where('date', date('Y-m-d'));
    // }

    public static function hit() {
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? null;
        if ($ipAddress) {
            try {
                static::firstOrCreate([
                    'ip'   => $ipAddress,
                    'worker_id' => auth('worker')->user()->id,
                    'visit_date' => date('Y-m-d'),
                ])->save();
            } catch (\Exception) {
                //should be empty
            }
        }
    }
}

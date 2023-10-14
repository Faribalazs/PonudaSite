<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Browser;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class DeviceAgent extends Model
{
    use HasFactory;

    protected $table = 'device_agent';

    protected $fillable = ['mobile', 'tablet', 'desktop', 'bot', 'unknown'];

    public $timestamps = false;

    public static function updateDeviceCount()
    {
        $ip = request()->ip();
        $deviceType = 'unknown';

        if (Browser::isMobile()) {
            $deviceType = 'mobile';
        } elseif (Browser::isTablet()) {
            $deviceType = 'tablet';
        } elseif (Browser::isDesktop()) {
            $deviceType = 'desktop';
        } elseif (Browser::isBot()) {
            $deviceType = 'bot';
        } 

        static::firstOrCreate([
            'date' => date('Y-m-d'),
        ])->save();

        $cacheKey = "device_count:$ip:$deviceType";

        // Check if the count has been incremented today
        if (!Cache::has($cacheKey)) {
            self::where('date', date('Y-m-d'))->increment($deviceType);

            // Set the cache to expire at 00:00 everyday
            $minutesRemaining = Carbon::now()->diffInMinutes(Carbon::now()->addDay()->startOfDay());
            Cache::put($cacheKey, true, $minutesRemaining);
        }
    }
}

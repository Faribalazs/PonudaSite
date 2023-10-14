<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Browser;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class BrowserAgent extends Model
{
    use HasFactory;

    protected $table = 'browser_agent';

    protected $fillable = ['chrome', 'firefox', 'opera', 'safari', 'ie', 'edge', 'unknown'];

    public $timestamps = false;

    public static function updateBrowserCount()
    {
        $ip = request()->ip();
        $browserType = 'unknown';

        if (Browser::isChrome()) {
            $browserType = 'chrome';
        } elseif (Browser::isFirefox()) {
            $browserType = 'firefox';
        } elseif (Browser::isOpera()) {
            $browserType = 'opera';
        } elseif (Browser::isSafari()) {
            $browserType = 'safari';
        } elseif (Browser::isIE()) {
            $browserType = 'ie';
        } elseif (Browser::isEdge()) {
            $browserType = 'edge';
        }
        
        static::firstOrCreate([
            'date' => date('Y-m-d'),
        ])->save();

        $cacheKey = "browser_count:$ip:$browserType";

        // Check if the count has been incremented today
        if (!Cache::has($cacheKey)) {
            self::where('date', date('Y-m-d'))->increment($browserType);

            // Set the cache to expire at 00:00 everyday
            $minutesRemaining = Carbon::now()->diffInMinutes(Carbon::now()->addDay()->startOfDay());
            Cache::put($cacheKey, true, $minutesRemaining);
        }
    }
}

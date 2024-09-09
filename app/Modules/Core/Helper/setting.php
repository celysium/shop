<?php

use App\Modules\Core\Facades\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    /**
     * @param string $key
     * @param mixed $default
     * @return string
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever("setting.$key", fn() => Setting::value($key, $default));
    }
}

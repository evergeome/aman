<?php

use Illuminate\Support\Facades\Cache;

function set_cache($name, $value, $minutes = 180)
{
    Cache::put(getLocation().'_'.$name, $value, now()->addMinutes($minutes));
}

function get_cache($name)
{
    return Cache::get(getLocation().'_'.$name);
}

function has_cache($name)
{
    return Cache::has(getLocation().'_'.$name);
}

function destroy_cache($name)
{
    Cache::forget(getLocation().'_'.$name);
}

function clear_cache()
{
    Cache::flush();
}

<?php
/** app/Helpers/Cookie.php */

use Illuminate\Support\Facades\Cookie;

function Lifetime()
{
    return env('SESSION_LIFETIME', 180);
}

function set_cookie($cookie_name, $cookie_value)
{
    Cookie::queue($cookie_name, $cookie_value, Lifetime(), '/', env('SESSION_DOMAIN'));
}

function get_cookie($cookie_name)
{
    return Cookie::get($cookie_name);
}

function has_cookie($cookie_name)
{
    return Cookie::has($cookie_name);
}

function destroy_cookie($cookie_name)
{
    Cookie::forget($cookie_name);
}

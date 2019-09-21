<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

if (! function_exists('add_active')) {
    function add_active(string ...$patterns)
    {
        return Route::currentRouteNamed(...$patterns) ? 'active' : '';
    }
}

if (! function_exists('image_url')) {
    function image_url(string $name = '/')
    {
        return url(Storage::url('img/'.$name));
    }
}

if (! function_exists('request_checkbox')) {
    function request_checkbox(Request $request, string $name)
    {
        $request->offsetSet($name, $request->has($name));
    }
}

if (! function_exists('color_contrast')) {
    function color_contrast(string $hex)
    {
        $r = hexdec(substr($hex, 1, 2));
        $g = hexdec(substr($hex, 3, 2));
        $b = hexdec(substr($hex, 5, 2));
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

        return ($yiq >= 128) ? 'black' : 'white';
    }
}

if (! function_exists('setting')) {
    function setting(string $name, $default = null)
    {
        return config('setting.'.$name, $default);
    }
}

if (! function_exists('site_name')) {
    function site_name()
    {
        return setting('name', config('app.name'));
    }
}

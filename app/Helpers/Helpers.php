<?php
use Illuminate\Support\Facades\Auth;

if (!function_exists('auth_login')) {
    function auth_login()
    {
        return Auth::check();
    }
}

if (!function_exists('auth_user')) {
    function auth_user()
    {
        return Auth::user();
    }
}

<?php


if (!function_exists('artadmin_user')) {
    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */

    function artadmin_user(){
    return  \Illuminate\Support\Facades\Auth::guard(config("artadmin.guard"))->user();
    }

}


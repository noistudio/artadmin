<?php

namespace Artadmin\Repository;

use Illuminate\Support\Facades\Artisan;

class CacheRepository {
    static function clear(){
        Artisan::call('view:clear');
        Artisan::call("route:clear");
        Artisan::call("event:clear");
        Artisan::call("config:clear");
        Artisan::call("cache:clear");

    }
}

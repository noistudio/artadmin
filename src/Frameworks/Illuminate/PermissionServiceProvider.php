<?php

namespace Artadmin\Frameworks\Illuminate;

use App\Models\User;
use Artadmin\Commands\CreateUser;
use Artadmin\Models\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as Base;


use Illuminate\Support\Facades\Gate;

/**
 * Class ServiceProvider
 * @package PrizyvaNet\Vault\Frameworks\Illuminate
 */
class PermissionServiceProvider extends Base
{
    public function register()
    {

    }

    public function boot(){


        try {

            Permission::get()->map(function ($permission) {

                Gate::define($permission->slug, function ($user=null) use ($permission) {

                    return Auth()->guard(config("artadmin.guard"))->user()->hasPermissionTo($permission);
                });
            });
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

}

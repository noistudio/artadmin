<?php

namespace Artadmin\Frameworks\Illuminate;

use Artadmin\Commands\CreateUser;
use Artadmin\Models\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider as Base;


use Illuminate\Support\Facades\Gate;

/**
 * Class ServiceProvider
 * @package PrizyvaNet\Vault\Frameworks\Illuminate
 */
class ServiceProvider extends Base
{
    public function register()
    {

    }

    public function boot(){


        Blade::directive('artadmin_role', function ($role){
            if($role=="root"){
                return "<?php if(auth(config('artadmin.guard'))->check() && auth(config('artadmin.guard'))->user()->hasRole({$role})): ?>";


            }else {
                return "<?php if( auth(config('artadmin.guard'))->check() && (auth(config('artadmin.guard'))->user()->hasRole({$role}) or auth(config('artadmin.guard'))->user()->hasRole('root')): ?>";

            }

            return "<?php if(auth(config('artadmin.guard'))->check() && auth(config('artadmin.guard'))->user()->hasRole({$role})): ?>";
        });
        Blade::directive('artadmin_endrole', function ($role){
            return "<?php endif; ?>";
        });

        Blade::directive('artadmin_permission', function ($permission){


            return "<?php if( auth(config('artadmin.guard'))->user()->can($permission)): ?>";
        });
        Blade::directive('artadmin_endpermission', function ($role){
            return "<?php endif; ?>";
        });

        View::share('top_menu_right', config("artadmin.top_menu_right"));
        View::share('top_menu_setup', config("artadmin.top_menu_setup"));
        View::share('sidebar_menu', config("artadmin.sidebar_menu"));
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../../routes/artadmin.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'artadmin');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'artadmin');
        $this->publishes([
            __DIR__.'/../../resources/public' => public_path('vendor/artadmin'),
        ], 'artadmin');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/artadmin'),
        ],"artadmin");

        $this->publishes([
            __DIR__.'/../../resources/lang' => resource_path('lang/vendor/artadmin'),
        ],"artadmin");

        $this->publishes([
            __DIR__.'/../../config/artadmin.php' => config_path('artadmin.php'),
        ],"artadmin");

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateUser::class
            ]);
        }


    }

}

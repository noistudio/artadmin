<?php


namespace Artadmin\Middleware;


use Closure;
class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {

        if( auth(config("artadmin.guard"))->user()->can("root") ) {
            return $next($request);
        }

        if( !auth(config("artadmin.guard"))->user()->can($permission) ) {
            abort(404);
        }
        return $next($request);
    }
}

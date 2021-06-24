<?php
namespace Artadmin\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if (!(Auth::guard(config("artadmin.guard"))->check())) {
            return redirect()->route("artadmin.login");
        }

        return $next($request);
    }
}

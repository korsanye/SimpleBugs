<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class MultiTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (App::environment('multitenant')) {
            $tenant = (array_first(explode(".", $request->getHttpHost())));
            config(['database.connections.mysql.database' => $tenant]);
        }

        return $next($request);
    }
}

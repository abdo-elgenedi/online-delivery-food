<?php

namespace App\Http\Middleware;

use App\Models\City;
use Closure;
use Illuminate\Support\Facades\Request;

class Location
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
            $cities=City::all();
            session()->put(['cities'=>$cities]);
        return $next($request);
    }
}

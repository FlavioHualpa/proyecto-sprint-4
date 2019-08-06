<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Http\Middleware\Request;

class MiddlewareAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
      if (auth()->user()->role === $role) {
        return $next($request);
      }

      return redirect('/home');
    }
}

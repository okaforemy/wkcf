<?php

namespace App\Http\Middleware;

use Closure;

class admin
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
        if(auth()->user()->privillege=='superadmin'){
            return $next($request);
        }
        //return redirect('/login')->with('error','Access denied!');
        abort(403, 'Unauthorized action.');
    }
}

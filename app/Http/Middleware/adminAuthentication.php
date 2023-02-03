<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;

class adminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = session('username');

        $users = Admin::where('name', $user)->where('dataType', 'ADMIN')->count();

        if($users < 0)
        {
            return redirect('auth.login');             
        }

        return $next($request);
    }
}

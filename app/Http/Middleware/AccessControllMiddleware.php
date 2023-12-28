<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Session;
use Auth;

class AccessControllMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $route = $request->route()->getName();;

        if($route) {

            $permission = Permission::where('route', $route)->first();

            if($permission && !$user->hasPermissionTo($permission)) {
                Session::flash('message.content', 'You do not have enough permissions to access the page you trying to reach.');
                Session::flash('message.level', 'error');

                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}

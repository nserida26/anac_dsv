<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @param  string|null  ...$guards
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next, ...$guards)
  {
    //$guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
      if (Auth::guard($guard)->check()) {
        $user = Auth::guard($guard)->user();


        // Role-based redirection
        if ($user->hasRole('admin')) {
          return redirect('/admin');
        } elseif ($user->hasRole('dg')) {
          return redirect('/dg');
        } elseif ($user->hasRole('dsv')) {
          return redirect('/dsv');
        } elseif ($user->hasRole('user')) {
          return redirect('/user');
        }

        // Default redirection for authenticated users
        return redirect('/');
      }
    }


    return $next($request);
  }
}
// Rida
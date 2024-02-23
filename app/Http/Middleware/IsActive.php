<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class IsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->user()?->is_active){
            return $next($request) ;
        }
        if($request->user()){
            $request->session()->invalidate();
        }
        return redirect('/')->with('flash', ['bannerStyle'=>'danger','banner'=>__('Your account is not active')]);
    }
}

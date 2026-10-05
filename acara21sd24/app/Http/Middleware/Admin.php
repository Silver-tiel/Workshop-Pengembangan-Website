<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next) 
    {
        $user = $request->user();
        if (! $user) 
            {
                return redirect('/login');
            }
        if ($user->role !== 'admin') 
            {
                abort(403);
            }
        return $next($request);
    }
    
}

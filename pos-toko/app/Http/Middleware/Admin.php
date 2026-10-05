<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next, ?string $role = 'admin'): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($request->user()->role !== $role) {
            abort(403);
        }

        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        Log::info('Middleware Admin executed', [
            'user' => $request->user()?->email ?? 'guest',
            'path' => $request->path(),
            'status' => $response->status(),
        ]);
    }
}

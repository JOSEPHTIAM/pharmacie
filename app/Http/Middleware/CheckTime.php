<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CheckTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $remainingTime = session('remaining_time');
        if ($remainingTime !== null) {
            $currentTime = time();
            if ($currentTime > $remainingTime) {
                return redirect()->route('connexion');
            }
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the 'adminId' exists in session (We use manual session to avoid creating a new facade)
        if (!$request->session()->has('adminId')) {
            return redirect()->route('auth_admin')->withErrors(['message' => 'Please login first!']);
        }

        // Check if the session has expired based on the session lifetime
        if (Session::has('last_activity') && time() - Session::get('last_activity') > config('session.lifetime') * 60) {
            // Session has expired, flush it and redirect to login page
            Session::flush(); // Clear the session
            return redirect()->route('auth_admin')->withErrors(['message' => 'Your session has expired, please log in again.']);
        }

        // Update the last activity timestamp to the current time
        Session::put('last_activity', time());

        // Continue with the request
        return $next($request);
    }
}

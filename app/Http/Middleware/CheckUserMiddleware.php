<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Users_KFCP;

class CheckUserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if 'loginId' exists in session
        if (!$request->session()->has('loginId')) {
            return redirect()->route('auth_login')->withErrors(['message' => 'Please login first!']);
        }

        $userId = $request->session()->get('loginId');
        $user = Users_KFCP::where('id_number', $userId)->first();

        // dd($user);

        // If user not found or not authorized
        if (!$user || is_null($user->is_authorized)) {
            return redirect()->route('auth_login')->withErrors(['message' => 'Your account is not yet authorized.']);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\AdminStatus;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::guard('admin')->check()) {
            return redirect()
                ->route('admin.login.form')
                ->withErrors(['email' => 'You need to log in first.']);
        }

        if (Auth::guard('admin')->user()->status !== AdminStatus::ACTIVE) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('admin.login.form')
                ->withErrors(['email' => 'Your account is not active.']);
        }

        return $next($request);
    }
}

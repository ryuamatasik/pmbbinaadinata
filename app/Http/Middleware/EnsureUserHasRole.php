<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $email = $user->email;

        // Logic based on strict email checking (as per current AuthController logic)
        if ($role === 'admin') {
            if ($email !== 'admin@binaadinata.ac.id') {
                abort(403, 'Unauthorized action. Admin access required.');
            }
        } elseif ($role === 'pimpinan') {
            if ($email !== 'pimpinan@binaadinata.ac.id') {
                abort(403, 'Unauthorized action. Pimpinan access required.');
            }
        } elseif ($role === 'mahasiswa') {
            // Student should NOT be admin or pimpinan
            if ($email === 'admin@binaadinata.ac.id' || $email === 'pimpinan@binaadinata.ac.id') {
                // Technically admins can access student pages, but let's keep it strict if needed.
                // For now, let's allow admins to see student view if they really want, 
                // or restrict it. Let's stick to the request: protect ADMIN/PIMPINAN routes.
            }
        }

        return $next($request);
    }
}

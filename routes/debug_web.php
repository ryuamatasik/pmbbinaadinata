<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Debug Route to inspect Auth state and redirection
Route::get('/debug-login', function () {
    $email = 'admin@gmail.com';
    $user = User::where('email', $email)->first();

    if (!$user) {
        return "User $email not found. Auto-create failed or not triggered.";
    }

    Auth::login($user);

    if (Auth::check()) {
        $role = 'unknown';
        if (str_contains($user->email, 'admin'))
            $role = 'admin';

        return "Logged in as {$user->name} ({$user->email}). Role detected: $role. <br>
        <a href='/admin/dashboard'>Go to Dashboard</a> <br>
        <a href='/dashboard-admin'>Go to /dashboard-admin</a>";
    } else {
        return "Failed to login via debug route.";
    }
});

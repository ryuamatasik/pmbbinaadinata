<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = 'pimpinan@binaadinata.ac.id';
$user = User::where('email', $email)->first();

if ($user) {
    echo "User exists. Updating role to pimpinan...\n";
    $user->update(['role' => 'pimpinan']);
    echo "Done.\n";
} else {
    echo "User does not exist. Creating user...\n";
    User::create([
        'name' => 'Pimpinan Kampus',
        'email' => $email,
        'password' => Hash::make('password'),
        'role' => 'pimpinan',
        'email_verified_at' => now(),
    ]);
    echo "User created with password: password\n";
}

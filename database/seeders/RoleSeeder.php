<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@binaadinata.ac.id'],
            [
                'name' => 'Administrator PMB',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Pimpinan
        User::firstOrCreate(
            ['email' => 'pimpinan@binaadinata.ac.id'],
            [
                'name' => 'Pimpinan Kampus',
                'password' => Hash::make('password'),
                'role' => 'pimpinan',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Users created:');
        $this->command->info('Admin: admin@binaadinata.ac.id / password');
        $this->command->info('Pimpinan: pimpinan@binaadinata.ac.id / password');
    }
}

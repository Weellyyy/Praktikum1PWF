<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah sudah ada user dengan email admin@example.com
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'admin',
            ]);

            $this->command->info('✅ Admin user created successfully!');
            $this->command->line('Email: admin@example.com');
            $this->command->line('Password: password');
            $this->command->line('Role: admin');
        } else {
            $this->command->info('✅ Admin user already exists.');
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       \App\Models\Admin::create([
            'username' => 'Admin',
            'email' => 'ecommerce@admin.com',
            'password' => Hash::make('1234567890')
        ]);
    }
}

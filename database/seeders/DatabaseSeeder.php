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
        \App\Models\Category::create([
            'category' => 'Sony',
            'image' => '../assets/images/image8.jpg'
        ]);
        \App\Models\Category::create([
            'category' => 'Laptops',
            'image' => '../assets/images/image8.jpg'
        ]);
        \App\Models\Category::create([
            'category' => 'Routers',
            'image' => '../assets/images/image8.jpg'
        ]);
        \App\Models\Category::create([
            'category' => 'Chargers',
            'image' => '../assets/images/image8.jpg'
        ]);
        \App\Models\Category::create([
            'category' => 'Headphones & Speakers',
            'image' => '../assets/images/image20.jpg'
        ]);
        \App\Models\Category::create([
            'category' => 'Cars & Automobiles',
            'image' => '../assets/images/image8.jpg'
        ]);
    }
}

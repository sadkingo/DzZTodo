<?php

namespace Database\Seeders;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'General', 'position' => 0],
            ['name' => 'Fun', 'position' => 0],
            ['name' => 'Work', 'position' => 0],
            ['name' => 'Daily', 'position' => 0],
        ]);
    }
}

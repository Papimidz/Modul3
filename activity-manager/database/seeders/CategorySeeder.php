<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::query()->insert([
            [
                'name' => 'Workshop',
                'slug' => 'workshop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Seminar',
                'slug' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pelatihan',
                'slug' => 'pelatihan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diskusi',
                'slug' => 'diskusi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Presentasi',
                'slug' => 'presentasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

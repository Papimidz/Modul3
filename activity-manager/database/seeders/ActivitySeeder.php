<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::query()->insert([
            [
                'title' => 'Workshop Git Dasar',
                'description' => 'Latihan kolaborasi repository.',
                'activity_date' => '2026-10-05',
                'category' => 'Workshop',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Seminar Web Quality',
                'description' => 'Pengenalan maintainability dan testing.',
                'activity_date' => '2026-10-12',
                'category' => 'Seminar',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pelatihan Laravel Dasar',
                'description' => 'Belajar dasar framework Laravel.',
                'activity_date' => '2026-10-15',
                'category' => 'Pelatihan',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Diskusi Proyek Web',
                'description' => 'Diskusi pengembangan proyek berbasis web.',
                'activity_date' => '2026-10-20',
                'category' => 'Diskusi',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Presentasi Landing Page',
                'description' => 'Presentasi hasil pengembangan landing page.',
                'activity_date' => '2026-09-30',
                'category' => 'Presentasi',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
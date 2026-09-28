<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $workshop = Category::where('slug', 'workshop')->firstOrFail();
        $seminar = Category::where('slug', 'seminar')->firstOrFail();
        $pelatihan = Category::where('slug', 'pelatihan')->firstOrFail();
        $diskusi = Category::where('slug', 'diskusi')->firstOrFail();
        $presentasi = Category::where('slug', 'presentasi')->firstOrFail();

        Activity::query()->insert([
            [
                'category_id' => $workshop->id,
                'code' => 'ACT-001',
                'title' => 'Workshop Git Dasar',
                'description' => 'Latihan kolaborasi repository.',
                'activity_date' => '2026-10-05',
                'category' => 'Workshop',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $seminar->id,
                'code' => 'ACT-002',
                'title' => 'Seminar Web Quality',
                'description' => 'Pengenalan maintainability dan testing.',
                'activity_date' => '2026-10-12',
                'category' => 'Seminar',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $pelatihan->id,
                'code' => 'ACT-003',
                'title' => 'Pelatihan Laravel Dasar',
                'description' => 'Belajar dasar framework Laravel.',
                'activity_date' => '2026-10-15',
                'category' => 'Pelatihan',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $diskusi->id,
                'code' => 'ACT-004',
                'title' => 'Diskusi Proyek Web',
                'description' => 'Diskusi pengembangan proyek berbasis web.',
                'activity_date' => '2026-10-20',
                'category' => 'Diskusi',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $presentasi->id,
                'code' => 'ACT-005',
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

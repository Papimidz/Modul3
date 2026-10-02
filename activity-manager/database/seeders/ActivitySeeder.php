<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::query()
            ->get()
            ->keyBy('slug');

        $activities = [
            ['ACT-001', 'Workshop Git Dasar', 'workshop', 'draft', '2026-10-01 09:00:00'],
            ['ACT-002', 'Seminar Web Quality', 'seminar', 'published', '2026-10-02 09:00:00'],
            ['ACT-003', 'Pelatihan Laravel Dasar', 'pelatihan', 'draft', '2026-10-03 09:00:00'],
            ['ACT-004', 'Diskusi Proyek Web', 'diskusi', 'published', '2026-10-04 09:00:00'],
            ['ACT-005', 'Presentasi Landing Page', 'presentasi', 'completed', '2026-10-05 09:00:00'],

            ['ACT-006', 'Workshop Git Branching', 'workshop', 'published', '2026-10-06 09:00:00'],
            ['ACT-007', 'Seminar Clean Code', 'seminar', 'draft', '2026-10-07 09:00:00'],
            ['ACT-008', 'Pelatihan Eloquent', 'pelatihan', 'published', '2026-10-08 09:00:00'],
            ['ACT-009', 'Diskusi Database', 'diskusi', 'draft', '2026-10-09 09:00:00'],
            ['ACT-010', 'Presentasi UI Web', 'presentasi', 'completed', '2026-10-10 09:00:00'],

            ['ACT-011', 'Workshop Laravel Routing', 'workshop', 'published', '2026-10-11 09:00:00'],
            ['ACT-012', 'Seminar Data Integrity', 'seminar', 'draft', '2026-10-12 09:00:00'],
            ['ACT-013', 'Pelatihan Form Request', 'pelatihan', 'published', '2026-10-13 09:00:00'],
            ['ACT-014', 'Diskusi Business Rule', 'diskusi', 'draft', '2026-10-14 09:00:00'],
            ['ACT-015', 'Presentasi Final Project', 'presentasi', 'completed', '2026-10-15 09:00:00'],
        ];

        foreach ($activities as [$code, $title, $slug, $status, $startAt]) {
            $category = $categories[$slug];

            Activity::query()->create([
                'category_id' => $category->id,
                'code' => $code,
                'title' => $title,
                'description' => 'Data latihan Special Challenge.',
                'activity_date' => substr($startAt, 0, 10),

                'start_at' => $startAt,
                'end_at' => date(
                    'Y-m-d H:i:s',
                    strtotime($startAt.' +3 hours')
                ),
                'location' => 'Lab Komputer',
                'capacity' => 30,
                'status' => $status,
            ]);
        }
    }
}

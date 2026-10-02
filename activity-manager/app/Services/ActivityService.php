<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ActivityService
{
    public function create(array $data): Activity
    {
        $data['status'] = 'draft';

        $data['activity_date'] = date(
            'Y-m-d',
            strtotime($data['start_at'])
        );

        return Activity::create($data);
    }

    public function update(Activity $activity, array $data): Activity
    {
        unset($data['status']);

        $data['activity_date'] = date(
            'Y-m-d',
            strtotime($data['start_at'])
        );

        if (isset($data['poster'])) {
            $newPosterPath = $data['poster']->store(
                'posters',
                'public'
            );

            if ($activity->poster_path) {
                Storage::disk('public')->delete(
                    $activity->poster_path
                );
            }

            $data['poster_path'] = $newPosterPath;

            unset($data['poster']);
        }

        $activity->update($data);

        return $activity->refresh();
    }

    public function publish(Activity $activity): Activity
    {
        if ($activity->status !== 'draft') {
            throw ValidationException::withMessages([
                'status' => 'Hanya kegiatan draft yang dapat dipublikasikan.',
            ]);
        }

        $requiredFields = [
            'category_id',
            'code',
            'title',
            'location',
            'start_at',
            'end_at',
            'capacity',
        ];

        foreach ($requiredFields as $field) {
            if (blank($activity->{$field})) {
                throw ValidationException::withMessages([
                    $field => "Field {$field} harus lengkap sebelum kegiatan dipublikasikan.",
                ]);
            }
        }

        $activity->update([
            'status' => 'published',
        ]);

        return $activity->refresh();
    }

    public function complete(Activity $activity): Activity
    {
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages([
                'status' => 'Hanya kegiatan published yang dapat diselesaikan.',
            ]);
        }

        $activity->update([
            'status' => 'completed',
        ]);

        return $activity->refresh();
    }
}

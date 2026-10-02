<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegistrationService
{
    public function register(Activity $activity, array $data): Registration
    {
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages([
                'activity' => 'Pendaftaran hanya untuk kegiatan published.',
            ]);
        }

        if (now()->greaterThanOrEqualTo($activity->start_at)) {
            throw ValidationException::withMessages([
                'activity' => 'Pendaftaran ditutup karena kegiatan sudah dimulai.',
            ]);
        }

        if (
            $activity->registrations()
                ->where('email', $data['email'])
                ->exists()
        ) {
            throw ValidationException::withMessages([
                'email' => 'Email sudah terdaftar pada kegiatan ini.',
            ]);
        }

        if ($activity->registered_count >= $activity->capacity) {
            throw ValidationException::withMessages([
                'activity' => 'Kapasitas kegiatan sudah penuh.',
            ]);
        }

        return DB::transaction(function () use ($activity, $data) {
            $registration = $activity->registrations()->create([
                'participant_name' => $data['participant_name'],
                'email' => $data['email'],
                'registered_at' => now(),
            ]);

            $activity->increment('registered_count');

            return $registration;
        });
    }
}

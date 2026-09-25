<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Services\ActivityService;
use DomainException;

class ActivityController extends Controller
{
    public function index()
    {
        $validStatuses = Activity::STATUSES;

        $status = request('status');

        $activities = Activity::query()
            ->when(
                in_array($status, $validStatuses, true),
                fn ($query) => $query->where('status', $status)
            )
            ->orderBy('activity_date')
            ->get();

        return view('activities.index', compact(
            'activities',
            'status'
        ));
    }

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return to_route('activities.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function store(
        StoreActivityRequest $request,
        ActivityService $service
    ) {
        $activity = $service->create($request->validated());

        return to_route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil dibuat.');
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity,
        ActivityService $service
    ) {
        try {
            $service->update(
                $activity,
                $request->validated()
            );
        } catch (DomainException $exception) {
            return back()
                ->withErrors([
                    'status' => $exception->getMessage(),
                ])
                ->withInput();
        }

        return to_route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }
}

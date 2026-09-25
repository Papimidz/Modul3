<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::query()
            ->orderBy('activity_date')
            ->get();

        return view('activities.index', compact('activities'));
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

    public function store(StoreActivityRequest $request)
    {
        Activity::create($request->validated());

        return to_route('activities.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity
    ) {
        $activity->update($request->validated());

        return to_route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }
}
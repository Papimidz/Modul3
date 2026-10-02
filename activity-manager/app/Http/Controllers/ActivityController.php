<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Services\ActivityService;
use DomainException;
use App\Models\Category;

class ActivityController extends Controller
{
    public function index()
    {
        $search = request('search');
        $categoryId = request('category_id');
        $status = request('status');
        $sort = request('sort', 'latest');

        $activities = Activity::query()
            ->with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when(
                in_array($status, Activity::STATUSES, true),
                function ($query) use ($status) {
                    $query->where('status', $status);
                }
            )
            ->orderBy(
                'start_at',
                $sort === 'oldest' ? 'asc' : 'desc'
            )
            ->paginate(10)
            ->withQueryString();

        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('activities.index', compact(
            'activities',
            'categories',
            'search',
            'categoryId',
            'status',
            'sort'
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

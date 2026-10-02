<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use App\Services\ActivityService;
use Illuminate\Support\Facades\Storage;

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
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('activities.create', compact('categories'));
    }

    public function edit(Activity $activity)
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('activities.edit', compact(
            'activity',
            'categories'
        ));
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
        $data = $request->validated();

        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request
                ->file('poster')
                ->store('posters', 'public');
        }

        unset($data['poster']);

        $activity = $service->create($data);

        return to_route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil dibuat.');
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity,
        ActivityService $service
    ) {
        $data = $request->validated();

        $oldPosterPath = $activity->poster_path;
        $newPosterPath = null;

        if ($request->hasFile('poster')) {
            $newPosterPath = $request
                ->file('poster')
                ->store('posters', 'public');

            $data['poster_path'] = $newPosterPath;
        }

        unset($data['poster']);

        $service->update($activity, $data);

        if (
            $newPosterPath &&
            $oldPosterPath &&
            $oldPosterPath !== $newPosterPath
        ) {
            Storage::disk('public')->delete($oldPosterPath);
        }

        return to_route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function publish(
        Activity $activity,
        ActivityService $service
    ) {
        $service->publish($activity);

        return back()->with(
            'success',
            'Kegiatan berhasil dipublikasikan.'
        );
    }

    public function complete(
        Activity $activity,
        ActivityService $service
    ) {
        $service->complete($activity);

        return back()->with(
            'success',
            'Kegiatan berhasil diselesaikan.'
        );
    }

    public function trash()
    {
        $activities = Activity::onlyTrashed()
            ->with('category')
            ->latest('deleted_at')
            ->paginate(10);

        return view('activities.trash', compact('activities'));
    }

    public function restore(int $id)
    {
        $activity = Activity::onlyTrashed()->findOrFail($id);

        $activity->restore();

        return to_route('activities.trash')
            ->with('success', 'Kegiatan berhasil direstore.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\ActivityType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ActivityTypeStoreRequest;
use App\Http\Requests\ActivityTypeUpdateRequest;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ActivityType::class);

        $search = $request->get('search', '');

        $activityTypes = ActivityType::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.activity_types.index',
            compact('activityTypes', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ActivityType::class);

        return view('app.activity_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityTypeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ActivityType::class);

        $validated = $request->validated();

        $activityType = ActivityType::create($validated);

        return redirect()
            ->route('activity-types.edit', $activityType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ActivityType $activityType): View
    {
        $this->authorize('view', $activityType);

        return view('app.activity_types.show', compact('activityType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ActivityType $activityType): View
    {
        $this->authorize('update', $activityType);

        return view('app.activity_types.edit', compact('activityType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ActivityTypeUpdateRequest $request,
        ActivityType $activityType
    ): RedirectResponse {
        $this->authorize('update', $activityType);

        $validated = $request->validated();

        $activityType->update($validated);

        return redirect()
            ->route('activity-types.edit', $activityType)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ActivityType $activityType
    ): RedirectResponse {
        $this->authorize('delete', $activityType);

        $activityType->delete();

        return redirect()
            ->route('activity-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}

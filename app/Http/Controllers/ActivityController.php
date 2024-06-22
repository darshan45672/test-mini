<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Activity;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ActivityType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Activity::class);

        $search = $request->get('search', '');

        $activities = Activity::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.activities.index', compact('activities', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Activity::class);

        $students = Student::pluck('usn', 'id');
        $activityTypes = ActivityType::pluck('id', 'id');

        return view(
            'app.activities.create',
            compact('students', 'activityTypes')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Activity::class);

        $validated = $request->validated();
        if ($request->hasFile('activityreport')) {
            $validated['activityreport'] = $request
                ->file('activityreport')
                ->store('public');
        }

        if ($request->hasFile('certificate')) {
            $validated['certificate'] = $request
                ->file('certificate')
                ->store('public');
        }

        $activity = Activity::create($validated);

        return redirect()
            ->route('activities.edit', $activity)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Activity $activity): View
    {
        $this->authorize('view', $activity);

        return view('app.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Activity $activity): View
    {
        $this->authorize('update', $activity);

        $students = Student::pluck('usn', 'id');
        $activityTypes = ActivityType::pluck('id', 'id');

        return view(
            'app.activities.edit',
            compact('activity', 'students', 'activityTypes')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ActivityUpdateRequest $request,
        Activity $activity
    ): RedirectResponse {
        $this->authorize('update', $activity);

        $validated = $request->validated();
        if ($request->hasFile('activityreport')) {
            if ($activity->activityreport) {
                Storage::delete($activity->activityreport);
            }

            $validated['activityreport'] = $request
                ->file('activityreport')
                ->store('public');
        }

        if ($request->hasFile('certificate')) {
            if ($activity->certificate) {
                Storage::delete($activity->certificate);
            }

            $validated['certificate'] = $request
                ->file('certificate')
                ->store('public');
        }

        $activity->update($validated);

        return redirect()
            ->route('activities.edit', $activity)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Activity $activity
    ): RedirectResponse {
        $this->authorize('delete', $activity);

        if ($activity->activityreport) {
            Storage::delete($activity->activityreport);
        }

        if ($activity->certificate) {
            Storage::delete($activity->certificate);
        }

        $activity->delete();

        return redirect()
            ->route('activities.index')
            ->withSuccess(__('crud.common.removed'));
    }
}

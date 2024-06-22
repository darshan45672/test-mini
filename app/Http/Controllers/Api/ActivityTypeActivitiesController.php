<?php

namespace App\Http\Controllers\Api;

use App\Models\ActivityType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityCollection;

class ActivityTypeActivitiesController extends Controller
{
    public function index(
        Request $request,
        ActivityType $activityType
    ): ActivityCollection {
        $this->authorize('view', $activityType);

        $search = $request->get('search', '');

        $activities = $activityType
            ->activities()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActivityCollection($activities);
    }

    public function store(
        Request $request,
        ActivityType $activityType
    ): ActivityResource {
        $this->authorize('create', Activity::class);

        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'activityreport' => ['file', 'max:1024'],
            'certificate' => ['file', 'max:1024'],
        ]);

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

        $activity = $activityType->activities()->create($validated);

        return new ActivityResource($activity);
    }
}

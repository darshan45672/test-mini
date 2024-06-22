<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityCollection;

class StudentActivitiesController extends Controller
{
    public function index(
        Request $request,
        Student $student
    ): ActivityCollection {
        $this->authorize('view', $student);

        $search = $request->get('search', '');

        $activities = $student
            ->activities()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActivityCollection($activities);
    }

    public function store(Request $request, Student $student): ActivityResource
    {
        $this->authorize('create', Activity::class);

        $validated = $request->validate([
            'activity_type_id' => ['required', 'exists:activity_types,id'],
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

        $activity = $student->activities()->create($validated);

        return new ActivityResource($activity);
    }
}

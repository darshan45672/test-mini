<?php

namespace App\Http\Controllers\Api;

use App\Models\ActivityType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityTypeResource;
use App\Http\Resources\ActivityTypeCollection;
use App\Http\Requests\ActivityTypeStoreRequest;
use App\Http\Requests\ActivityTypeUpdateRequest;

class ActivityTypeController extends Controller
{
    public function index(Request $request): ActivityTypeCollection
    {
        $this->authorize('view-any', ActivityType::class);

        $search = $request->get('search', '');

        $activityTypes = ActivityType::search($search)
            ->latest()
            ->paginate();

        return new ActivityTypeCollection($activityTypes);
    }

    public function store(
        ActivityTypeStoreRequest $request
    ): ActivityTypeResource {
        $this->authorize('create', ActivityType::class);

        $validated = $request->validated();

        $activityType = ActivityType::create($validated);

        return new ActivityTypeResource($activityType);
    }

    public function show(
        Request $request,
        ActivityType $activityType
    ): ActivityTypeResource {
        $this->authorize('view', $activityType);

        return new ActivityTypeResource($activityType);
    }

    public function update(
        ActivityTypeUpdateRequest $request,
        ActivityType $activityType
    ): ActivityTypeResource {
        $this->authorize('update', $activityType);

        $validated = $request->validated();

        $activityType->update($validated);

        return new ActivityTypeResource($activityType);
    }

    public function destroy(
        Request $request,
        ActivityType $activityType
    ): Response {
        $this->authorize('delete', $activityType);

        $activityType->delete();

        return response()->noContent();
    }
}

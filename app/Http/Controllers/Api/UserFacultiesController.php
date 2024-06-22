<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FacultyResource;
use App\Http\Resources\FacultyCollection;

class UserFacultiesController extends Controller
{
    public function index(Request $request, User $user): FacultyCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $faculties = $user
            ->faculties()
            ->search($search)
            ->latest()
            ->paginate();

        return new FacultyCollection($faculties);
    }

    public function store(Request $request, User $user): FacultyResource
    {
        $this->authorize('create', Faculty::class);

        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
        ]);

        $faculty = $user->faculties()->create($validated);

        return new FacultyResource($faculty);
    }
}

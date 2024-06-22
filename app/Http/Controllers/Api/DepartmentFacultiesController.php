<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FacultyResource;
use App\Http\Resources\FacultyCollection;

class DepartmentFacultiesController extends Controller
{
    public function index(
        Request $request,
        Department $department
    ): FacultyCollection {
        $this->authorize('view', $department);

        $search = $request->get('search', '');

        $faculties = $department
            ->faculties()
            ->search($search)
            ->latest()
            ->paginate();

        return new FacultyCollection($faculties);
    }

    public function store(
        Request $request,
        Department $department
    ): FacultyResource {
        $this->authorize('create', Faculty::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $faculty = $department->faculties()->create($validated);

        return new FacultyResource($faculty);
    }
}

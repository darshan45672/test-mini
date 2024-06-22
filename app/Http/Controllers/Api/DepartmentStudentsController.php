<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentCollection;

class DepartmentStudentsController extends Controller
{
    public function index(
        Request $request,
        Department $department
    ): StudentCollection {
        $this->authorize('view', $department);

        $search = $request->get('search', '');

        $students = $department
            ->students()
            ->search($search)
            ->latest()
            ->paginate();

        return new StudentCollection($students);
    }

    public function store(
        Request $request,
        Department $department
    ): StudentResource {
        $this->authorize('create', Student::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'college_id' => ['required', 'exists:colleges,id'],
            'sem' => ['required', 'numeric'],
            'usn' => ['required', 'max:255', 'string'],
        ]);

        $student = $department->students()->create($validated);

        return new StudentResource($student);
    }
}

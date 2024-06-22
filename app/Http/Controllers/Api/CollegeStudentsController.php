<?php

namespace App\Http\Controllers\Api;

use App\Models\College;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentCollection;

class CollegeStudentsController extends Controller
{
    public function index(Request $request, College $college): StudentCollection
    {
        $this->authorize('view', $college);

        $search = $request->get('search', '');

        $students = $college
            ->students()
            ->search($search)
            ->latest()
            ->paginate();

        return new StudentCollection($students);
    }

    public function store(Request $request, College $college): StudentResource
    {
        $this->authorize('create', Student::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'sem' => ['required', 'numeric'],
            'usn' => ['required', 'max:255', 'string'],
        ]);

        $student = $college->students()->create($validated);

        return new StudentResource($student);
    }
}

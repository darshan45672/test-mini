<?php

namespace App\Http\Controllers\Api;

use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollegeResource;
use App\Http\Resources\CollegeCollection;
use App\Http\Requests\CollegeStoreRequest;
use App\Http\Requests\CollegeUpdateRequest;

class CollegeController extends Controller
{
    public function index(Request $request): CollegeCollection
    {
        $this->authorize('view-any', College::class);

        $search = $request->get('search', '');

        $colleges = College::search($search)
            ->latest()
            ->paginate();

        return new CollegeCollection($colleges);
    }

    public function store(CollegeStoreRequest $request): CollegeResource
    {
        $this->authorize('create', College::class);

        $validated = $request->validated();

        $college = College::create($validated);

        return new CollegeResource($college);
    }

    public function show(Request $request, College $college): CollegeResource
    {
        $this->authorize('view', $college);

        return new CollegeResource($college);
    }

    public function update(
        CollegeUpdateRequest $request,
        College $college
    ): CollegeResource {
        $this->authorize('update', $college);

        $validated = $request->validated();

        $college->update($validated);

        return new CollegeResource($college);
    }

    public function destroy(Request $request, College $college): Response
    {
        $this->authorize('delete', $college);

        $college->delete();

        return response()->noContent();
    }
}

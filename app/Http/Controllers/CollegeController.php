<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CollegeStoreRequest;
use App\Http\Requests\CollegeUpdateRequest;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', College::class);

        $search = $request->get('search', '');

        $colleges = College::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.colleges.index', compact('colleges', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', College::class);

        return view('app.colleges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CollegeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', College::class);

        $validated = $request->validated();

        $college = College::create($validated);

        return redirect()
            ->route('colleges.edit', $college)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, College $college): View
    {
        $this->authorize('view', $college);

        return view('app.colleges.show', compact('college'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, College $college): View
    {
        $this->authorize('update', $college);

        return view('app.colleges.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CollegeUpdateRequest $request,
        College $college
    ): RedirectResponse {
        $this->authorize('update', $college);

        $validated = $request->validated();

        $college->update($validated);

        return redirect()
            ->route('colleges.edit', $college)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        College $college
    ): RedirectResponse {
        $this->authorize('delete', $college);

        $college->delete();

        return redirect()
            ->route('colleges.index')
            ->withSuccess(__('crud.common.removed'));
    }
}

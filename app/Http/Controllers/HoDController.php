<?php

namespace App\Http\Controllers;

use App\Models\HoD;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\HoDStoreRequest;
use App\Http\Requests\HoDUpdateRequest;

class HoDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', HoD::class);

        $search = $request->get('search', '');

        $hoDs = HoD::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.ho_ds.index', compact('hoDs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', HoD::class);

        $departments = Department::pluck('id', 'id');

        return view('app.ho_ds.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HoDStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', HoD::class);

        $validated = $request->validated();

        $hoD = HoD::create($validated);

        return redirect()
            ->route('ho-ds.edit', $hoD)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, HoD $hoD): View
    {
        $this->authorize('view', $hoD);

        return view('app.ho_ds.show', compact('hoD'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, HoD $hoD): View
    {
        $this->authorize('update', $hoD);

        $departments = Department::pluck('id', 'id');

        return view('app.ho_ds.edit', compact('hoD', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        HoDUpdateRequest $request,
        HoD $hoD
    ): RedirectResponse {
        $this->authorize('update', $hoD);

        $validated = $request->validated();

        $hoD->update($validated);

        return redirect()
            ->route('ho-ds.edit', $hoD)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, HoD $hoD): RedirectResponse
    {
        $this->authorize('delete', $hoD);

        $hoD->delete();

        return redirect()
            ->route('ho-ds.index')
            ->withSuccess(__('crud.common.removed'));
    }
}

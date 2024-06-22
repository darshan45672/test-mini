<?php

namespace App\Http\Controllers\Api;

use App\Models\HoD;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\HoDResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\HoDCollection;
use App\Http\Requests\HoDStoreRequest;
use App\Http\Requests\HoDUpdateRequest;

class HoDController extends Controller
{
    public function index(Request $request): HoDCollection
    {
        $this->authorize('view-any', HoD::class);

        $search = $request->get('search', '');

        $hoDs = HoD::search($search)
            ->latest()
            ->paginate();

        return new HoDCollection($hoDs);
    }

    public function store(HoDStoreRequest $request): HoDResource
    {
        $this->authorize('create', HoD::class);

        $validated = $request->validated();

        $hoD = HoD::create($validated);

        return new HoDResource($hoD);
    }

    public function show(Request $request, HoD $hoD): HoDResource
    {
        $this->authorize('view', $hoD);

        return new HoDResource($hoD);
    }

    public function update(HoDUpdateRequest $request, HoD $hoD): HoDResource
    {
        $this->authorize('update', $hoD);

        $validated = $request->validated();

        $hoD->update($validated);

        return new HoDResource($hoD);
    }

    public function destroy(Request $request, HoD $hoD): Response
    {
        $this->authorize('delete', $hoD);

        $hoD->delete();

        return response()->noContent();
    }
}

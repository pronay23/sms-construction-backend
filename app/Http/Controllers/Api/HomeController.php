<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;
use App\Http\Resources\HomeResource;
use App\Models\Home;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $homes = Home::query()
            ->latest()
            ->paginate(12);

        return HomeResource::collection($homes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHomeRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (Home::where('slug', $slug)->exists()) {
                $slug = $baseSlug.'-'.$counter++;
            }

            $validated['slug'] = $slug;
        }

        $home = Home::create($validated);

        return (new HomeResource($home))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Home $home): HomeResource
    {
        return new HomeResource($home);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeRequest $request, Home $home): HomeResource
    {
        $validated = $request->validated();

        if (isset($validated['title']) && empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (Home::where('slug', $slug)->where('id', '!=', $home->id)->exists()) {
                $slug = $baseSlug.'-'.$counter++;
            }

            $validated['slug'] = $slug;
        }

        $home->update($validated);

        return new HomeResource($home);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home): Response
    {
        $home->delete();

        return response()->noContent();
    }
}

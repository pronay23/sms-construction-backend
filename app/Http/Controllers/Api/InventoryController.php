<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $inventories = Inventory::query()
            ->latest()
            ->paginate(15);

        return InventoryResource::collection($inventories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request): JsonResponse
    {
        $inventory = Inventory::create($request->validated());

        return (new InventoryResource($inventory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory): InventoryResource
    {
        return new InventoryResource($inventory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, Inventory $inventory): InventoryResource
    {
        $inventory->update($request->validated());

        return new InventoryResource($inventory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory): Response
    {
        $inventory->delete();

        return response()->noContent();
    }
}

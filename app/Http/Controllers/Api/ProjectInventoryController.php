<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectInventoryRequest;
use App\Http\Resources\ProjectInventoryResource;
use App\Models\ProjectInventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProjectInventoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ProjectInventoryResource::collection(
            ProjectInventory::query()->latest('date')->latest('id')->paginate(15),
        );
    }

    public function store(StoreProjectInventoryRequest $request): JsonResponse
    {
        $projectInventory = ProjectInventory::create([
            ...$request->validated(),
            'date' => $request->validated('date') ?? now()->toDateString(),
        ]);

        return (new ProjectInventoryResource($projectInventory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}

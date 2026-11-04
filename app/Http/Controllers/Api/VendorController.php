<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $vendors = Vendor::query()
            ->latest()
            ->paginate(15);

        return VendorResource::collection($vendors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request): JsonResponse
    {
        $vendor = Vendor::create($request->validated());

        return (new VendorResource($vendor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor): VendorResource
    {
        return new VendorResource($vendor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor): VendorResource
    {
        $vendor->update($request->validated());

        return new VendorResource($vendor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor): Response
    {
        $vendor->delete();

        return response()->noContent();
    }
}

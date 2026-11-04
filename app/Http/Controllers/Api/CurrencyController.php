<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $currencies = Currency::query()
            ->latest()
            ->paginate(15);

        return CurrencyResource::collection($currencies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurrencyRequest $request): JsonResponse
    {
        $currency = Currency::create($request->validated());

        return (new CurrencyResource($currency))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency): CurrencyResource
    {
        return new CurrencyResource($currency);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurrencyRequest $request, Currency $currency): CurrencyResource
    {
        $currency->update($request->validated());

        return new CurrencyResource($currency);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency): Response
    {
        $currency->delete();

        return response()->noContent();
    }
}

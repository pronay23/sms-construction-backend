<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Expense::query()->with(['project', 'category', 'payment', 'currency', 'vendor']);

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->integer('project_id'));
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }
        if ($request->filled('payment_id')) {
            $query->where('payment_id', $request->integer('payment_id'));
        }
        if ($request->filled('currency_id')) {
            $query->where('currency_id', $request->integer('currency_id'));
        }
        if ($request->filled('vendor_id')) {
            $query->where('vendor_id', $request->integer('vendor_id'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->string('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->string('date_to'));
        }

        $expenses = $query->latest()->paginate(15);

        return ExpenseResource::collection($expenses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request): JsonResponse
    {
        $expense = Expense::create($request->validated());

        return (new ExpenseResource($expense->load(['project', 'category', 'payment', 'currency', 'vendor'])))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense): ExpenseResource
    {
        return new ExpenseResource($expense->load(['project', 'category', 'payment', 'currency', 'vendor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense): ExpenseResource
    {
        $expense->update($request->validated());

        return new ExpenseResource($expense->load(['project', 'category', 'payment', 'currency', 'vendor']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense): Response
    {
        $expense->delete();

        return response()->noContent();
    }
}

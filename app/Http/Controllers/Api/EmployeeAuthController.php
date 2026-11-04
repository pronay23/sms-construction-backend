<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class EmployeeAuthController extends Controller
{
    /**
     * Authenticate an employee and return their data.
     */
    public function login(LoginEmployeeRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $employee = Employee::where('employee_id', $validated['employee_id'])->first();

        if (! $employee || ! Hash::check($validated['password'], $employee->password)) {
            return response()->json([
                'message' => 'Invalid employee ID or password.',
            ], 401);
        }

        return response()->json([
            'data' => new EmployeeResource($employee),
        ]);
    }

    /**
     * Log out the authenticated employee.
     */
    public function logout(): JsonResponse
    {
        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }
}

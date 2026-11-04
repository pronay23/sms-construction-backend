<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => ['sometimes', 'required', 'date'],
            'project_id' => ['sometimes', 'required', 'exists:projects,id'],
            'category_id' => ['sometimes', 'required', 'exists:categories,id'],
            'payment_id' => ['sometimes', 'required', 'exists:payments,id'],
            'currency_id' => ['sometimes', 'required', 'exists:currencies,id'],
            'description' => ['nullable', 'string'],
            'vendor_id' => ['sometimes', 'required', 'exists:vendors,id'],
            'amount' => ['sometimes', 'required', 'numeric', 'min:0'],
            'vat' => ['nullable', 'numeric', 'min:0'],
            'vat_amount' => ['nullable', 'numeric', 'min:0'],
            'cash_deposit' => ['nullable', 'numeric', 'min:0'],
            'received_from_bank' => ['nullable', 'numeric', 'min:0'],
            'received_from_owner' => ['nullable', 'numeric', 'min:0'],
            'status' => ['sometimes', 'required', 'in:paid,pending'],
        ];
    }
}

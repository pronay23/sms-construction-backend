<?php

namespace App\Http\Resources;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Expense
 */
class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'project_id' => $this->project_id,
            'project' => $this->whenLoaded('project', fn () => $this->project->name),
            'category_id' => $this->category_id,
            'category' => $this->whenLoaded('category', fn () => $this->category->name),
            'payment_id' => $this->payment_id,
            'payment' => $this->whenLoaded('payment', fn () => $this->payment->name),
            'currency_id' => $this->currency_id,
            'currency' => $this->whenLoaded('currency', fn () => $this->currency->name),
            'currency_symbol' => $this->whenLoaded('currency', fn () => $this->currency->symbol ?? $this->currency->short_name),
            'currency_short_name' => $this->whenLoaded('currency', fn () => $this->currency->short_name),
            'description' => $this->description,
            'vendor_id' => $this->vendor_id,
            'vendor' => $this->whenLoaded('vendor', fn () => $this->vendor->name),
            'amount' => $this->amount,
            'vat' => $this->vat,
            'vat_amount' => $this->vat_amount,
            'cash_deposit' => $this->cash_deposit,
            'received_from_bank' => $this->received_from_bank,
            'received_from_owner' => $this->received_from_owner,
            'status' => $this->status,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}

<?php

namespace App\Models;

use Database\Factories\ExpenseFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'date',
    'project_id',
    'category_id',
    'payment_id',
    'currency_id',
    'description',
    'vendor_id',
    'amount',
    'vat',
    'vat_amount',
    'cash_deposit',
    'received_from_bank',
    'received_from_owner',
    'status',
])]
class Expense extends Model
{
    /** @use HasFactory<ExpenseFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'amount' => 'decimal:2',
            'vat' => 'decimal:2',
            'vat_amount' => 'decimal:2',
            'cash_deposit' => 'decimal:2',
            'received_from_bank' => 'decimal:2',
            'received_from_owner' => 'decimal:2',
            'status' => 'string',
        ];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}

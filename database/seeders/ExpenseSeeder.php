<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project = Project::first();
        $category = Category::first();
        $payment = Payment::first();
        $currency = Currency::first();
        $vendor = Vendor::first();

        if (! $project || ! $category || ! $payment || ! $currency || ! $vendor) {
            return;
        }

        $expenses = [
            [
                'date' => '2026-11-01',
                'project_id' => $project->id,
                'category_id' => $category->id,
                'payment_id' => $payment->id,
                'currency_id' => $currency->id,
                'description' => 'Cement purchase for site work',
                'vendor_id' => $vendor->id,
                'amount' => 5000.00,
                'vat' => 5.00,
                'vat_amount' => 250.00,
                'cash_deposit' => 0.00,
                'received_from_bank' => 5250.00,
                'received_from_owner' => 0.00,
                'status' => 'paid',
            ],
            [
                'date' => '2026-11-02',
                'project_id' => $project->id,
                'category_id' => $category->id,
                'payment_id' => $payment->id,
                'currency_id' => $currency->id,
                'description' => 'Steel rebar delivery',
                'vendor_id' => $vendor->id,
                'amount' => 8000.00,
                'vat' => 5.00,
                'vat_amount' => 400.00,
                'cash_deposit' => 0.00,
                'received_from_bank' => 0.00,
                'received_from_owner' => 8400.00,
                'status' => 'pending',
            ],
        ];

        foreach ($expenses as $expense) {
            Expense::create($expense);
        }
    }
}

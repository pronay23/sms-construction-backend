<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            ['name' => 'Bank Transfer'],
            ['name' => 'Cash Payment'],
            ['name' => 'Check Payment'],
            ['name' => 'Online Payment'],
            ['name' => 'Credit Card'],
        ];

        foreach ($payments as $payment) {
            Payment::firstOrCreate(['name' => $payment['name']], $payment);
        }
    }
}

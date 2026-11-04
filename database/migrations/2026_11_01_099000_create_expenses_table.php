<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('payment_id')->constrained('payments');
            $table->foreignId('currency_id')->constrained('currencies');
            $table->text('description')->nullable();
            $table->foreignId('vendor_id')->constrained('vendors');
            $table->decimal('amount', 15, 2);
            $table->decimal('vat', 5, 2)->default(0);
            $table->decimal('vat_amount', 15, 2)->default(0);
            $table->decimal('cash_deposit', 15, 2)->default(0);
            $table->decimal('received_from_bank', 15, 2)->default(0);
            $table->decimal('received_from_owner', 15, 2)->default(0);
            $table->enum('status', ['paid', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};

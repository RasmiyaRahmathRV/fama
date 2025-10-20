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
        Schema::create('contract_rentals', function (Blueprint $table) {
            $table->id();
            $table->string('contract_rental_code');
            $table->Unsignedinteger('contract_id');
            $table->decimal('rent_per_annum_payable', 8, 2);
            $table->decimal('commission_percentage', 8, 2)->nullable();
            $table->decimal('commission', 8, 2)->nullable();
            $table->decimal('deposit_percentage', 8, 2)->nullable();
            $table->decimal('deposit', 8, 2)->nullable();
            $table->decimal('rent_receivable_per_month', 8, 2);
            $table->decimal('rent_receivable_per_annum', 8, 2);
            $table->decimal('roi_perc', 8, 2);
            $table->decimal('expected_profit', 8, 2);
            $table->decimal('profit_percentage', 8, 2);
            $table->date('receivable_start_date')->nullable();
            $table->decimal('total_payment_to_vendor', 8, 2);
            $table->decimal('total_otc', 8, 2)->nullable();
            $table->decimal('final_cost', 8, 2);
            $table->decimal('initial_investment', 8, 2);
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_rentals');
    }
};

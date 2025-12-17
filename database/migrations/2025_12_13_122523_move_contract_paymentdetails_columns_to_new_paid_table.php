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
        // 1️⃣ Create the new table
        Schema::create('contract_payable_clears', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('contract_payment_detail_id');
            $table->decimal('pending_amount', 12, 2)->default(0);
            $table->decimal('paid_amount', 12, 2);
            $table->date('paid_date');
            $table->unsignedBigInteger('paid_mode')->default(0);
            $table->unsignedBigInteger('paid_by');
            $table->unsignedBigInteger('paid_bank')->nullable();
            $table->string('paid_cheque_number')->nullable();
            $table->text('payment_remarks')->nullable();
            $table->timestamps();
        });

        // 3️⃣ Drop the columns from old table
        Schema::table('contract_payment_details', function (Blueprint $table) {
            $table->dropColumn(['pending_amount', 'paid_amount', 'paid_date', 'paid_mode', 'paid_by', 'paid_bank', 'paid_cheque_number', 'payment_remarks']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1️⃣ Add columns back to old table
        Schema::table('contract_payment_details', function (Blueprint $table) {
            $table->integer('paid_mode')->default(0);
            $table->unsignedBigInteger('paid_bank')->nullable();
            $table->string('paid_cheque_number')->nullable();
            $table->text('payment_remarks')->nullable();
            $table->decimal('paid_amount', 12, 2)->nullable();
            $table->decimal('pending_amount', 12, 2)->nullable();
            $table->date('paid_date')->nullable();
            $table->integer('paid_by')->nullable();
        });

        // 3️⃣ Drop new table
        Schema::dropIfExists('contract_payable_clears');
    }
};

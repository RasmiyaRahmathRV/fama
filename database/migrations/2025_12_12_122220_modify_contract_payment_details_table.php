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
        Schema::table('contract_payment_details', function (Blueprint $table) {
            $table->integer('paid_mode')->default(0);
            $table->unsignedBigInteger('paid_bank')->nullable();
            $table->string('paid_cheque_number')->nullable();
            $table->text('payment_remarks')->nullable();
            $table->boolean('has_returned')->default(0);
            $table->date('returned_date')->nullable();
            $table->text('returned_reason')->nullable();
            $table->unsignedBigInteger('returned_by')->default(0);
        });

        Schema::table('contract_payments', function (Blueprint $table) {
            $table->integer('has_payment_started')->default(0);
            $table->boolean('has_fully_paid')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_payment_details', function (Blueprint $table) {
            $table->dropColumn('paid_mode');
            $table->dropColumn('paid_bank');
            $table->dropColumn('paid_cheque_number');
            $table->dropColumn('mode_change_reason');
            $table->dropColumn('has_returned');
            $table->dropColumn('returned_date');
            $table->dropColumn('returned_reason');
            $table->dropColumn('returned_by');
        });


        Schema::table('contract_payments', function (Blueprint $table) {
            $table->dropColumn('has_payment_started');
            $table->dropColumn('has_fully_paid');
        });
    }
};

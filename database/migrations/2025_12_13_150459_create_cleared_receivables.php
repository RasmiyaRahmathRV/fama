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
        Schema::create('cleared_receivables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agreement_payment_details_id');
            $table->decimal('paid_amount', 12, 2);
            $table->decimal('pending_amount', 12, 2)->default(0);
            $table->date('paid_date');
            $table->unsignedBigInteger('paid_mode_id');
            $table->unsignedBigInteger('paid_bank_id')->nullable();
            $table->string('paid_cheque_number')->nullable();
            $table->string('payment_remarks')->nullable();
            $table->integer('paid_by')->nullable();
            $table->timestamps();
        });



        Schema::table('agreement_payment_details', function (Blueprint $table) {
            $table->dropColumn([
                'paid_amount',
                'pending_amount',
                'paid_date',
                'paid_mode_id',
                'paid_bank_id',
                'paid_cheque_number',
                'mode_change_reason'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agreement_payment_details', function (Blueprint $table) {
            $table->decimal('paid_amount', 12, 2)->nullable();
            $table->decimal('pending_amount', 12, 2)->default(0);
            $table->date('paid_date')->nullable();
            $table->unsignedBigInteger('paid_mode_id')->nullable();
            $table->unsignedBigInteger('paid_bank_id')->nullable();
            $table->string('paid_cheque_number')->nullable();
            $table->string('mode_change_reason')->nullable();
        });

        Schema::dropIfExists('cleared_receivables');
    }
};

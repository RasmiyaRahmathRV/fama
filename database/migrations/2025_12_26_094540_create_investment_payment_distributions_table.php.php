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
        Schema::create('investor_payment_distributions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('payout_id');
            $table->unsignedBigInteger('investor_id');

            $table->decimal('amount_paid', 12, 2);
            $table->date('paid_date');

            $table->unsignedBigInteger('paid_mode_id')->default(0);
            $table->unsignedBigInteger('paid_bank')->nullable();
            $table->string('paid_cheque_number')->nullable();
            $table->text('payment_remarks')->nullable();

            $table->unsignedBigInteger('paid_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_payment_distributions');
    }
};

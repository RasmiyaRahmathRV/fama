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
        Schema::create('agreement_payment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agreement_id');
            $table->unsignedBigInteger('agreement_payment_id');
            $table->unsignedBigInteger('payment_mode_id');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('cheque_issuer')->nullable();
            $table->string('cheque_issuer_name')->nullable();
            $table->string('cheque_issuer_id')->nullable();
            $table->date('payment_date');
            $table->decimal('payment_amount', 8, 2);
            $table->integer('is_payment_received')->default(0)->comment('0-Pending, 1-Received, 2-Half Received,3-Bounced');
            $table->decimal('paid_amount', 8, 2)->nullable();
            $table->decimal('pending_amount', 8, 2)->nullable();
            $table->date('paid_date')->nullable();
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('agreement_id')->references('id')->on('agreements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreement_payment_details');
    }
};

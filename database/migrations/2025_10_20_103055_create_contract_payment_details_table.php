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
        Schema::create('contract_payment_details', function (Blueprint $table) {
            $table->id();
            $table->Unsignedinteger('contract_id');
            $table->Unsignedinteger('contract_payment_id');
            $table->Unsignedinteger('payment_mode_id');
            $table->date('payment_date');
            $table->decimal('payment_amount', 8, 2);
            $table->Unsignedinteger('bank_id')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('cheque_issuer')->nullable();
            $table->string('cheque_issuer_name')->nullable();
            $table->string('cheque_issuer_id')->nullable();
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
        Schema::dropIfExists('contract_payment_details');
    }
};

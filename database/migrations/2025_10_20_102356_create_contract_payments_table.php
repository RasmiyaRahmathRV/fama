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
        Schema::create('contract_payments', function (Blueprint $table) {
            $table->id();
            $table->Unsignedinteger('contract_id');
            $table->integer('installment_id');
            $table->integer('interval');
            $table->string('beneficiary')->nullable();
            $table->integer('added_by');
            $table->integer('updated_by');
            $table->integer('deleted_by');
            $table->timestamps();

            $table->foreign('contract_id')
                ->references('id')->on('contracts')
                ->onDelete('cascade');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_payments');
    }
};

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
        Schema::create('contract_payment_receivables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->date('receivable_date');
            $table->decimal('receivable_amount', 8, 2);
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('contract_payment_receivables');
    }
};

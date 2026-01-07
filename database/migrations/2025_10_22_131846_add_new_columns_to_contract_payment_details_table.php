<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contract_payment_details', function (Blueprint $table) {
            //
            $table->decimal('paid_amount', 8, 2)->nullable();
            $table->date('paid_date')->nullable();
            $table->decimal('pending_amount', 8, 2)->nullable();
            $table->integer('paid_by')->nullable();
            $table->integer('paid_status')->comment('0-not paid, 1-paid,  2-half paid')->default(0);
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_payment_details', function (Blueprint $table) {
            $table->dropColumn([
                'paid_amount',
                'paid_date',
                'pending_amount',
                'paid_by',
                'paid_status',
            ]);
        });
    }
};

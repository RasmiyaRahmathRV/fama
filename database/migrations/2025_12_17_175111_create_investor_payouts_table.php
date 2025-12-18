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
        Schema::create('investor_payouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investor_id');
            $table->unsignedBigInteger('investment_id');
            $table->decimal('total_payout_amount', 12, 2);
            $table->integer('type_of_payout')->default(1)->comments('1-profit release,2-investment amount release, 3-referal commission release');
            $table->date('total_payout_date');
            $table->unsignedBigInteger('payout_by');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_payouts');
    }
};

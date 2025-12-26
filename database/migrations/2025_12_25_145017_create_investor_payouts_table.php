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
            $table->unsignedBigInteger('investment_id');
            $table->unsignedBigInteger('investor_id')->comment('receiver');
            $table->integer('payout_type')->comment('1-profit, 2-commission, 3-principal');
            $table->integer('payout_reference_id')->comment('type profit or principal - investment id, commission - referal table id');
            $table->string('payout_release_month');
            $table->decimal('payout_amount', 12, 2);
            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->decimal('amount_pending', 12, 2)->default(0);

            $table->boolean('is_processed')->default(0);

            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by');
            $table->timestamps();
            $table->softDeletes();
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

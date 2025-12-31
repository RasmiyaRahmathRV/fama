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
        Schema::create('investment_referrals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investment_id');
            $table->unsignedBigInteger('investor_id');
            $table->unsignedBigInteger('investor_referror_id');
            $table->decimal('referral_commission_perc', 8, 2);
            $table->decimal('referral_commission_amount', 12, 2)->default(0);
            // $table->decimal('referral_commission_released_amount', 12, 2)->default(0);
            // $table->decimal('referral_commission_pending_amount', 12, 2)->default(0);
            $table->unsignedBigInteger('referral_commission_frequency_id');
            $table->integer('referral_commission_status')->default(0)->comment('0-not released,1-released,2-partially released');

            $table->date('last_referral_commission_released_date')->nullable();
            $table->decimal('total_commission_pending', 12, 2)->default(0);
            $table->decimal('total_commission_released', 12, 2)->default(0);
            $table->decimal('current_month_commission_released', 12, 2)->default(0);
            $table->decimal('commission_released_perc', 8, 2)->default(0);

            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('added_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_referrals');
    }
};

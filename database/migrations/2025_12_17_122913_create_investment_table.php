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
        Schema::create('profit_intervals', function (Blueprint $table) {
            $table->id();
            $table->string('profit_interval_name');
            $table->boolean('status')->comment('1-Acive, 0-Inactive');
            $table->timestamps();
        });
        Schema::create('referral_commission_frequencies', function (Blueprint $table) {
            $table->id();
            $table->string('commission_frequency_name');
            $table->boolean('status')->comment('1-Acive, 0-Inactive');

            $table->timestamps();
        });
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('investment_code');
            $table->unsignedBigInteger('investor_id');
            $table->unsignedBigInteger('payout_batch_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('profit_interval_id');
            $table->decimal('investment_amount', 12, 2);
            $table->integer('investment_type')->comment('0-New', '1-Existing');
            $table->decimal('received_amount', 12, 2)->default(0);
            $table->decimal('total_received_amount', 12, 2)->default(0);
            $table->decimal('balance_amount', 12, 2)->default(0);
            $table->integer('has_fully_received')->comment('0-Not Received,1-fully Received,2-Partially Received');
            $table->date('investment_date');

            $table->integer('investment_tenure')->comment('In Months');
            $table->integer('grace_period')->comment("In Days");
            $table->date('maturity_date');


            $table->decimal('profit_perc', 8, 2);
            $table->decimal('profit_amount', 12, 2);
            $table->decimal('profit_amount_per_interval', 12, 2);


            // Release Dates
            // $table->date('profit_release_date')->nullable();
            $table->integer('profit_release_date')->nullable();

            $table->date('last_profit_released_date')->nullable();
            $table->date('next_profit_release_date')->nullable();
            $table->date('next_referral_commission_release_date')->nullable();

            // Nominee
            $table->string('nominee_name')->nullable();
            $table->string('nominee_email')->nullable();
            $table->string('nominee_phone')->nullable();




            // investor Payout
            $table->unsignedBigInteger('company_bank_id');

            // investor Payout
            $table->unsignedBigInteger('investor_bank_id');

            // Status
            $table->integer('investment_status')->default(1)->comment('0-Inactive,1-Active');
            $table->integer('terminate_status')->default(0)->comment('0-Not Terminated, 1-Termination Requested,2-Terminated');

            // Reinvestment
            $table->boolean('reinvestment_or_not')->default(0)->comment('0-No,1-Yes');
            $table->integer('parent_investment_id')->nullable();
            $table->boolean('has_reinvestment')->default(0)->comment('0-No,1-Yes');
            $table->boolean('reinvested_count')->nullable();



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
        Schema::dropIfExists('investments');
    }
};

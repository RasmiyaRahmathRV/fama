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
        Schema::table('contract_unit_details', function (Blueprint $table) {
            $table->string('unit_number')->nullable()->change();
            $table->decimal('unit_rent_per_annum', 12, 2)->change();
            $table->decimal('rent_per_partition', 12, 2)->change();
            $table->decimal('rent_per_bedspace', 12, 2)->change();
            $table->decimal('rent_per_room', 12, 2)->change();
        });


        Schema::table('contract_otc', function (Blueprint $table) {
            $table->decimal('cost_of_development', 12, 2)->change();
            $table->decimal('cost_of_bed', 12, 2)->change();
            $table->decimal('cost_of_matress', 12, 2)->change();
            $table->decimal('appliances', 12, 2)->change();
            $table->decimal('decoration', 12, 2)->change();
            $table->decimal('dewa_deposit', 12, 2)->change();
            $table->decimal('ejari', 12, 2)->change();
            $table->decimal('cost_of_cabinets', 12, 2)->change();
        });


        Schema::table('contract_rentals', function (Blueprint $table) {
            $table->decimal('rent_per_annum_payable', 12, 2)->change();
            $table->decimal('commission_percentage', 12, 2)->change();
            $table->decimal('commission', 12, 2)->change();
            $table->decimal('deposit_percentage', 12, 2)->change();
            $table->decimal('deposit', 12, 2)->change();
            $table->decimal('rent_receivable_per_month', 12, 2)->change();
            $table->decimal('rent_receivable_per_annum', 12, 2)->change();
            $table->decimal('roi_perc', 12, 2)->change();
            $table->decimal('expected_profit', 12, 2)->change();
            $table->decimal('profit_percentage', 12, 2)->change();
            $table->decimal('total_payment_to_vendor', 12, 2)->change();
            $table->decimal('total_otc', 12, 2)->change();
            $table->decimal('final_cost', 12, 2)->change();
            $table->decimal('initial_investment', 12, 2)->change();
            $table->decimal('receivable_installments')->nullable(false)->change();
        });

        Schema::table('contract_payment_details', function (Blueprint $table) {
            $table->decimal('payment_amount', 12, 2)->change();
            $table->decimal('paid_amount', 12, 2)->change();
            $table->decimal('pending_amount', 12, 2)->change();
        });

        Schema::table('contract_payment_receivables', function (Blueprint $table) {
            $table->decimal('receivable_amount', 12, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_unit_details', function (Blueprint $table) {
            $table->string('unit_number')->nullable()->change();
            $table->decimal('unit_rent_per_annum', 8, 2)->change();
            $table->decimal('rent_per_partition', 8, 2)->change();
            $table->decimal('rent_per_bedspace', 8, 2)->change();
            $table->decimal('rent_per_room', 8, 2)->change();
        });


        Schema::table('contract_otc', function (Blueprint $table) {
            $table->decimal('cost_of_development', 8, 2)->change();
            $table->decimal('cost_of_bed', 8, 2)->change();
            $table->decimal('cost_of_matress', 8, 2)->change();
            $table->decimal('appliances', 8, 2)->change();
            $table->decimal('decoration', 8, 2)->change();
            $table->decimal('dewa_deposit', 8, 2)->change();
            $table->decimal('ejari', 8, 2)->change();
            $table->decimal('cost_of_cabinets', 8, 2)->change();
        });


        Schema::table('contract_rentals', function (Blueprint $table) {
            $table->decimal('rent_per_annum_payable', 8, 2)->change();
            $table->decimal('commission_percentage', 8, 2)->change();
            $table->decimal('commission', 8, 2)->change();
            $table->decimal('deposit_percentage', 8, 2)->change();
            $table->decimal('deposit', 8, 2)->change();
            $table->decimal('rent_receivable_per_month', 8, 2)->change();
            $table->decimal('rent_receivable_per_annum', 8, 2)->change();
            $table->decimal('roi_perc', 8, 2)->change();
            $table->decimal('expected_profit', 8, 2)->change();
            $table->decimal('profit_percentage', 8, 2)->change();
            $table->decimal('total_payment_to_vendor', 8, 2)->change();
            $table->decimal('total_otc', 8, 2)->change();
            $table->decimal('final_cost', 8, 2)->change();
            $table->decimal('initial_investment', 8, 2)->change();
        });

        Schema::table('contract_payment_details', function (Blueprint $table) {
            $table->decimal('payment_amount', 8, 2)->change();
            $table->decimal('paid_amount', 8, 2)->change();
            $table->decimal('pending_amount', 8, 2)->change();
        });

        Schema::table('contract_payment_receivables', function (Blueprint $table) {
            $table->decimal('receivable_amount', 8, 2)->change();
        });
    }
};

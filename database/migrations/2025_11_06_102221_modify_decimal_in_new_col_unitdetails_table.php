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
            $table->decimal('unit_rent_per_month', 12, 2)->default(0);
            $table->decimal('unit_profit', 12, 2)->change();
            $table->decimal('unit_revenue', 12, 2)->change();
            $table->decimal('unit_amount_payable', 12, 2)->change();
            $table->decimal('unit_commission', 12, 2)->change();
            $table->decimal('unit_deposit', 12, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_unit_details', function (Blueprint $table) {
            $table->drop('unit_rent_per_month');
            $table->decimal('unit_profit', 8, 2)->change();
            $table->decimal('unit_revenue', 8, 2)->change();
            $table->decimal('unit_amount_payable', 8, 2)->change();
            $table->decimal('unit_commission', 8, 2)->change();
            $table->decimal('unit_deposit', 8, 2)->change();
        });
    }
};

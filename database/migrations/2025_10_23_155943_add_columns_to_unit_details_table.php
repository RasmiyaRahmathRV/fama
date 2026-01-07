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
            $table->decimal('unit_profit_perc')->nullable()->after('rent_per_room');
            $table->decimal('unit_profit')->nullable();
            $table->decimal('unit_revenue')->nullable();
            $table->decimal('unit_amount_payable')->nullable();
            $table->decimal('unit_commission')->nullable();
            $table->decimal('unit_deposit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_unit_details', function (Blueprint $table) {
            $table->dropColumn([
                'unit_profit_perc',
                'unit_profit',
                'unit_revenue',
                'unit_amount_payable',
                'unit_commission',
                'unit_deposit'
            ]);
        });
    }
};

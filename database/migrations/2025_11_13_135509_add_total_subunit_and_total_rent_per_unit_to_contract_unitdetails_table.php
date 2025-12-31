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
        Schema::table('contract_units', function (Blueprint $table) {
            $table->integer('total_subunit_count_per_contract')->default(0)->after('unit_type_count');
        });

        Schema::table('contract_unit_details', function (Blueprint $table) {
            $table->decimal('total_rent_per_unit_per_month', 12, 2)->default(0)->after('rent_per_unit_per_annum');
            $table->integer('subunittype')->default(0)->after('total_rent_per_unit_per_month');
            $table->integer('subunitcount_per_unit')->default(0)->after('subunittype');
            $table->decimal('subunit_rent_per_unit', 12, 2)->default(0)->after('subunitcount_per_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_units', function (Blueprint $table) {
            $table->dropColumn('total_subunit_count_per_contract');
        });

        Schema::table('contract_unit_details', function (Blueprint $table) {
            $table->dropColumn('total_rent_per_unit_per_month');
            $table->dropColumn('subunittype');
            $table->dropColumn('subunitcount_per_unit');
            $table->dropColumn('subunit_rent_per_unit');
        });
    }
};

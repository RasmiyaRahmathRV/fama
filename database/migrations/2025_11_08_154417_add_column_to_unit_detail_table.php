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
            $table->boolean('watchman_room')->default(0)->after('business_type');
        });

        Schema::table('contract_unit_details', function (Blueprint $table) {
            $table->boolean('room')->default(0)->after('bedspace');
            $table->boolean('maid_room')->default(0)->after('room');
            $table->decimal('rent_per_flat', 12, 2)->default(0)->after('rent_per_room');
            $table->decimal('rent_per_unit_per_month', 12, 2)->default(0)->after('rent_per_flat');
            $table->decimal('rent_per_unit_per_annum', 12, 2)->default(0)->after('rent_per_unit_per_month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('contract_units', function (Blueprint $table) {
            $table->dropColumn('watchman_room');
        });


        Schema::table('contract_unit_details', function (Blueprint $table) {
            $table->dropColumn('room');
            $table->dropColumn('maid_room');
            $table->dropColumn('rent_per_flat');
            $table->dropColumn('rent_per_unit_per_month');
            $table->dropColumn('rent_per_unit_per_annum');
        });
    }
};

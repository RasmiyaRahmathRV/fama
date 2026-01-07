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
            $table->text('unit_property_type')->nullable()->after('unit_type_count');
            $table->text('no_of_floors')->nullable()->after('unit_property_type');
            $table->text('floor_numbers')->nullable()->after('no_of_floors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_units', function (Blueprint $table) {
            $table->dropColumn('unit_property_type');
            $table->dropColumn('no_of_floors');
            $table->dropColumn('floor_numbers');
        });
    }
};

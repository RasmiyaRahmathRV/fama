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
            //
            $table->integer('subunit_occupied_count')->nullable(true);
            $table->integer('subunit_vacant_count')->nullable(true);
            $table->decimal('total_payment_received', 12, 2)->nullable(true);
            $table->decimal('total_payment_pending', 12, 2)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_unit_details', function (Blueprint $table) {
            //
            $table->dropColumn('subunit_occupied_count')->nullable(true);
            $table->dropColumn('subunit_vacant_count')->nullable(true);
            $table->dropColumn('total_payment_received', 12, 2)->nullable(true);
            $table->dropColumn('total_payment_pending', 12, 2)->nullable(true);
        });
    }
};

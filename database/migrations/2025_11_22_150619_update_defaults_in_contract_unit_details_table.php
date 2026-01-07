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
            $table->integer('subunit_occupied_count')->default(0);
            $table->integer('subunit_vacant_count')->default(0);
            $table->decimal('total_payment_received', 12, 2)->default(0);
            $table->decimal('total_payment_pending', 12, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_unit_details', function (Blueprint $table) {
            $table->dropColumn([
                'subunit_occupied_count',
                'subunit_vacant_count',
                'total_payment_received',
                'total_payment_pending'
            ]);
        });
    }
};

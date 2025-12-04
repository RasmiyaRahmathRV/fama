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
        Schema::table('agreement_units', function (Blueprint $table) {
            //
            $table->decimal('unit_revenue', 12, 2)->default(0)->after('rent_per_annum_agreement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agreement_units', function (Blueprint $table) {
            //
            $table->dropColumn('unit_revenue');
        });
    }
};

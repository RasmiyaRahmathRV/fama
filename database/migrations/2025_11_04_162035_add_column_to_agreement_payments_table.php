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
        Schema::table('agreement_payments', function (Blueprint $table) {
            //
            $table->decimal('total_rent_annum', 12, 2)->after('beneficiary')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agreement_payments', function (Blueprint $table) {
            //
            $table->dropColumn('total_rent_annum');
        });
    }
};

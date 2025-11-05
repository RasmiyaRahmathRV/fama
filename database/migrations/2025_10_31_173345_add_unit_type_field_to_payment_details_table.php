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
        Schema::table('agreement_payment_details', function (Blueprint $table) {
            //
            $table->integer('contract_unit_id')->after('payment_mode_id');
            $table->integer('agreement_unit_id')->after('contract_unit_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agreement_payment_details', function (Blueprint $table) {
            //
            $table->dropColumn('contract_unit_id');
            $table->dropColumn('agreement_unit_id');
        });
    }
};

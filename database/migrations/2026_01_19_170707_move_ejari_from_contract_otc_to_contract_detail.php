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
        Schema::table('contract_details', function (Blueprint $table) {
            $table->string('ejari')->nullable()->after('contract_fee');
        });

        DB::statement("
            UPDATE contract_details cd
            JOIN contract_otc co ON co.contract_id = cd.contract_id
            SET cd.ejari = co.ejari
        ");

        Schema::table('contract_otc', function (Blueprint $table) {
            $table->dropColumn('ejari');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_otc', function (Blueprint $table) {
            $table->string('ejari')->nullable()->after('dewa_deposit');
        });

        DB::statement("
            UPDATE contract_otc co
            JOIN contract_details cd ON cd.contract_id = co.contract_id
            SET co.ejari = cd.ejari
        ");

        Schema::table('contract_details', function (Blueprint $table) {
            $table->dropColumn('ejari');
        });
    }
};

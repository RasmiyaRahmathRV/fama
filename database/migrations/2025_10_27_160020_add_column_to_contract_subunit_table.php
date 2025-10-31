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
        Schema::table('contract_subunit_details', function (Blueprint $table) {
            //
            $table->integer('subunit_type')->after('subunit_no')->comment('1-partition, 2-bedspace, 3-room, 4-full flat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_subunit_details', function (Blueprint $table) {
            //
            $table->dropColumn('subunit_type');
        });
    }
};

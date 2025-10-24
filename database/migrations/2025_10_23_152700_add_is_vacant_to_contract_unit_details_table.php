<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contract_unit_details', function (Blueprint $table) {
            //
            $table->boolean('is_vacant')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_unit_details', function (Blueprint $table) {
            //
            $table->dropColumn('is_vacant');
        });
    }
};

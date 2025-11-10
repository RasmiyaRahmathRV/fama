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
        Schema::table('contract_types', function (Blueprint $table) {
            $table->string('shortcode')->nullable();
        });

        DB::table('contract_types')->update([
            'shortcode' => 'DF', // set default integer value
        ]);

        DB::table('contract_types')->update([
            'shortcode' => 'FF'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_types', function (Blueprint $table) {
            $table->string('shortcode');
        });
    }
};

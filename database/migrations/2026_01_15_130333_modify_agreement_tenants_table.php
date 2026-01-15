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
        //
        Schema::table('agreement_tenants', function (Blueprint $table) {
            $table->string('tenant_street')->nullable();
            $table->string('tenant_city')->nullable();
            $table->string('emirate_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('agreement_tenants', function (Blueprint $table) {
            $table->dropColumn('tenant_street');
            $table->dropColumn('tenant_city');
            $table->dropColumn('emirate_id');
        });
    }
};

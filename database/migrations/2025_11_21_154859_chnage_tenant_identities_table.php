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
        Schema::table('tenant_identities', function (Blueprint $table) {
            $table->string('first_field_label')->nullable()->change();
            $table->string('first_field_type')->nullable()->change();
            $table->string('first_field_id')->nullable()->change();
            $table->string('first_field_name')->nullable()->change();
            // add other fields you want to make nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenant_identities', function (Blueprint $table) {
            $table->string('first_field_label')->nullable(false)->change();
            $table->string('first_field_type')->nullable(false)->change();
            $table->string('first_field_id')->nullable(false)->change();
            $table->string('first_field_name')->nullable(false)->change();
            // revert other fields to not nullable
        });
    }
};

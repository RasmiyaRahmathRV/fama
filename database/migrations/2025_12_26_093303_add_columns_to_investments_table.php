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
        Schema::table('investments', function (Blueprint $table) {
            //
            $table->date('termination_requested_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->integer('termination_duration')->nullable();
            $table->string('termination_document')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            //
            $table->dropColumn('termination_requested_date');
            $table->dropColumn('termination_date');
            $table->dropColumn('termination_duration');
            $table->dropColumn('termination_document');
        });
    }
};

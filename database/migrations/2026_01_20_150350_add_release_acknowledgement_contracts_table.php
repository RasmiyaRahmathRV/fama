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
        Schema::table('contracts', function (Blueprint $table) {
            $table->boolean('is_acknowledgement_released')->after('is_aknowledgement_uploaded')->default(0);
            $table->date('acknowledgement_released_date')->after('is_acknowledgement_released')->nullable();
            $table->unsignedBigInteger('acknowledgement_released_by')->after('acknowledgement_released_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('is_acknowledgement_released');
            $table->dropColumn('acknowledgement_released_date');
            $table->dropColumn('acknowledgement_released_by');
        });
    }
};

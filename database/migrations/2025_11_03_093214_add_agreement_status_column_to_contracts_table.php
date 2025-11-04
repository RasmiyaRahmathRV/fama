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
            //
            $table->boolean('is_agreement_added')
                ->after('rejected_reason')
                ->default(0)
                ->nullable(true)
                ->comment('0 - not added, 1 - added');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            //
            $table->dropColumn('is_agreement_added');
        });
    }
};

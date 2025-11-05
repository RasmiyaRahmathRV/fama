<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agreement_units', function (Blueprint $table) {
            $table->renameColumn('rent_per_annum', 'rent_per_month');
        });

        Schema::table('agreement_units', function (Blueprint $table) {
            $table->decimal('rent_per_month', 12, 2)->change();

            $table->decimal('rent_per_annum_agreement', 12, 2)->after('rent_per_month')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('agreement_units', function (Blueprint $table) {
            $table->dropColumn('rent_per_annum_agreement');
        });

        Schema::table('agreement_units', function (Blueprint $table) {
            $table->renameColumn('rent_per_month', 'rent_per_annum');

            $table->decimal('rent_per_annum', 8, 2)->change();
        });
    }
};

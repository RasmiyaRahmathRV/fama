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
        Schema::table('properties', function (Blueprint $table) {

            $table->unsignedBigInteger('company_id')->nullable()->change();

            $table->decimal('latitude', 10, 8)->nullable()->after('plot_no');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->text('address')->nullable()->after('longitude');
            $table->text('location')->nullable()->after('address');
            $table->text('remarks')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('properties', function (Blueprint $table) {

            $table->unsignedBigInteger('company_id')->nullable(false)->change();

            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('address');
            $table->dropColumn('location');
            $table->dropColumn('remarks');
        });
    }
};

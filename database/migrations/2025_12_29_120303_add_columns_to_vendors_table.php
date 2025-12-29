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
        Schema::table('vendors', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('company_id')->nullable()->change();

            $table->text('landline_number')->nullable()->after('contact_person_email');
            $table->text('location')->nullable()->after('landline_number');
            $table->text('remarks')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('company_id')->nullable(false)->change();

            $table->dropColumn('landline_number');
            $table->dropColumn('location');
            $table->dropColumn('remarks');
        });
    }
};

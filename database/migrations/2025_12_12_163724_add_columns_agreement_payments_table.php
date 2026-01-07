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
        Schema::table('agreement_payments', function (Blueprint $table) {
            // Payment info
            $table->boolean('has_payment_received')->default(0)->after('added_by');
            $table->boolean('has_payment_fully_received')->default(0)->after('added_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('agreement_payments', function (Blueprint $table) {
            $table->dropColumn([
                'has_payment_received',
                'has_payment_fully_received',

            ]);
        });
    }
};

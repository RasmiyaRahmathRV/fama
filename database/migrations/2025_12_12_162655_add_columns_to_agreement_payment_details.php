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
        Schema::table('agreement_payment_details', function (Blueprint $table) {
            // Payment info
            $table->unsignedBigInteger('paid_mode_id')->nullable()->after('payment_mode_id');
            $table->unsignedBigInteger('paid_bank_id')->nullable()->after('paid_mode_id');
            $table->string('paid_cheque_number')->nullable()->after('paid_bank_id');
            $table->string('mode_change_reason')->nullable()->after('paid_cheque_number');

            // Bounced cheque info
            $table->date('bounced_date')->nullable()->after('mode_change_reason');
            $table->string('bounced_reason')->nullable()->after('bounced_date');
            $table->unsignedBigInteger('bounced_by')->nullable()->after('bounced_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agreement_payment_details', function (Blueprint $table) {
            //
            $table->dropColumn([
                'paid_mode_id',
                'paid_bank_id',
                'paid_cheque_number',
                'mode_change_reason',
                'bounced_date',
                'bounced_reason',
                'bounced_by'
            ]);
        });
    }
};

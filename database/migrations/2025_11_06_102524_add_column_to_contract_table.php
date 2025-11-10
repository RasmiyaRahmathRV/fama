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
            $table->boolean('renew_reject_status')->default(0)->comment('1-rejected')->after('renewed_by');
            $table->text('renew_reject_reason')->nullable()->after('renew_reject_status');
            $table->integer('renew_rejected_by')->nullable()->after('renew_reject_reason');
            $table->integer('contract_rejected_by')->nullable()->after('rejected_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('renew_reject_status');
            $table->dropColumn('renew_reject_reason');
            $table->dropColumn('renew_rejected_by');
            $table->dropColumn('contract_rejected_by');
        });
    }
};

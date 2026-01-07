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
            $table->integer('contract_status')
                ->comment('0-Pending, 1-Processing, 2-Approved, 3-Rejected, 4-Send for Approval, 5-Approval on Hold, 6-Sign Pending, 7- Signed, 8-Expired')
                ->change();
            if (!Schema::hasColumn('contracts', 'signed_at')) {
                $table->date('signed_at')->nullable()->after('contract_status');
            }

            if (!Schema::hasColumn('contracts', 'signed_by')) {
                $table->integer('signed_by')->nullable()->after('signed_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->integer('contract_status')->comment('0-Pending, 1-Processing, 2-Approved, 3-Rejected')->change();
            if (Schema::hasColumn('contracts', 'signed_at')) {
                $table->dropColumn('signed_at');
            }
            if (Schema::hasColumn('contracts', 'signed_by')) {
                $table->dropColumn('signed_by');
            }
        });
    }
};

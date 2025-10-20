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
        Schema::create('contract_details', function (Blueprint $table) {
            $table->id();
            $table->Unsignedinteger('contract_id');
            $table->decimal('contract_fee', 8, 2)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_in_months');
            $table->integer('duration_in_days')->nullable();
            $table->date('closing_date');
            $table->integer('grace_period');
            $table->Unsignedinteger('added_by');
            $table->Unsignedinteger('updated_by')->nullable();
            $table->Unsignedinteger('deleted_by')->nullable();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_details');
    }
};

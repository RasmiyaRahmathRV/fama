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
        Schema::create('contract_subunit_details', function (Blueprint $table) {
            $table->id();
            $table->Unsignedinteger('contract_id');
            $table->Unsignedinteger('contract_unit_id');
            $table->Unsignedinteger('contract_unit_detail_id');
            $table->string('subunit_no');
            $table->string('subunit_code')->comment('proj. no / company code / unit no / subunit no');
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_subunit_details');
    }
};

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
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('contract_unit_id');
            $table->unsignedBigInteger('contract_unit_detail_id');
            $table->string('subunit_no');
            $table->string('subunit_code')->comment('proj. no / company code / unit no / subunit no');
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();

            $table->foreign('contract_id')
                ->references('id')->on('contracts')
                ->onDelete('cascade');
            $table->foreign('contract_unit_id')
                ->references('id')->on('contract_units')
                ->onDelete('cascade');
            $table->foreign('contract_unit_detail_id')
                ->references('id')->on('contract_unit_details')
                ->onDelete('cascade');


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

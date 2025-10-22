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
        Schema::create('contract_units', function (Blueprint $table) {
            $table->id();
            $table->string('contract_unit_code');
            $table->unsignedBigInteger('contract_id');
            $table->integer('building_type')->comment('0-normal, 1-full building');
            $table->integer('business_type')->comment('1-b2b, 2-b2c');
            $table->integer('no_of_units');
            $table->text('unit_numbers')->nullable();
            $table->text('unit_type_count')->nullable();
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();

            $table->foreign('contract_id')
                ->references('id')->on('contracts')
                ->onDelete('cascade');


            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_units');
    }
};

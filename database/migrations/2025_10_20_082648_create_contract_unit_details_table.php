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
        Schema::create('unit_types', function (Blueprint $table) {
            $table->id();
            $table->string('unit_type');
            $table->timestamps();
        });

        Schema::create('unit_status', function (Blueprint $table) {
            $table->id();
            $table->string('unit_status');
            $table->timestamps();
        });

        Schema::create('unit_size_units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_size_unit');
            $table->timestamps();
        });

        Schema::create('contract_unit_details', function (Blueprint $table) {
            $table->id();
            $table->Unsignedinteger('contract_id');
            $table->Unsignedinteger('contract_unit_id');
            $table->string('unit_number');
            $table->integer('unit_type_id');
            $table->string('floor_no');
            $table->integer('unit_status_id');
            $table->decimal('unit_rent_per_annum', 8, 2);
            $table->integer('fb_unit_count')->default(0);
            $table->integer('unit_size_unit_id')->nullable();
            $table->integer('unit_size')->nullable();
            $table->integer('property_type_id');
            $table->boolean('partition')->default(false);
            $table->boolean('bedspace')->default(false);
            $table->integer('total_partition')->default(0);
            $table->integer('total_bedspace')->default(0);
            $table->decimal('rent_per_partition', 8, 2)->nullable();
            $table->decimal('rent_per_bedspace', 8, 2)->nullable();
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_unit_details');
        Schema::dropIfExists('unit_types');
        Schema::dropIfExists('unit_status');
        Schema::dropIfExists('unit_size_units');
    }
};

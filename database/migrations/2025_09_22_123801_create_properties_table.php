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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->Unsignedinteger('company_id');
            $table->Unsignedinteger('area_id');
            $table->Unsignedinteger('locality_id');
            $table->Unsignedinteger('property_type_id')->nullable();
            $table->string('property_code');
            $table->string('property_name');
            $table->string('property_size')->nullable();
            $table->Unsignedinteger('property_size_unit')->nullable();
            $table->string('plot_no');
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->unique(['company_id', 'area_id', 'locality_id', 'property_name']);

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};

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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->Unsignedinteger('company_id');
            $table->string('vendor_code');
            $table->string('vendor_name');
            $table->string('vendor_phone')->nullable();
            $table->string('vendor_email')->nullable();
            $table->text('vendor_address')->nullable();
            $table->string('accountant_name')->nullable();
            $table->string('accountant_phone')->nullable();
            $table->string('accountant_email')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->unique(['company_id', 'vendor_name']);

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};

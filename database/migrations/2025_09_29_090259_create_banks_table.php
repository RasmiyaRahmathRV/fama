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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->Unsignedinteger('company_id')->nullable();
            $table->string('bank_code');
            $table->string('bank_name');
            $table->string('bank_short_code');
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            // $table->unique(['company_id', 'bank_name']);

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};

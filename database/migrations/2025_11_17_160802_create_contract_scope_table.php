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
        Schema::create('contract_scopes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->longText('scope');
            $table->string('file_name');
            $table->integer('generated_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('contract_id')
                ->references('id')
                ->on('contracts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_scopes');
    }
};

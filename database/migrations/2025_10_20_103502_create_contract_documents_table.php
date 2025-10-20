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
        Schema::create('contract_documents', function (Blueprint $table) {
            $table->id();
            $table->Unsignedinteger('contract_id');
            $table->string('original_document_path');
            $table->string('original_documant_name');
            $table->string('signed_document_path');
            $table->string('signed_document_name');
            $table->integer('signed_status')->default(0)->comment('0-unsinged, 1-mr.muneer signed,2- mr.muneer and vendor signed');
            $table->integer('added_by');
            $table->integer('updated_by');
            $table->integer('deleted_by');
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_documents');
    }
};

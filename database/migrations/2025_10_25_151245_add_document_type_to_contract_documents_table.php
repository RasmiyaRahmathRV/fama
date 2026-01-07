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
        Schema::table('contract_documents', function (Blueprint $table) {
            $table->integer('document_type_id')->nullable()->after('contract_id');
            $table->string('signed_document_path')->nullable()->change();
            $table->renameColumn('original_documant_name', 'original_document_name');
            $table->string('signed_document_name')->nullable()->change();
            $table->integer('updated_by')->nullable()->change();
            $table->integer('deleted_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_documents', function (Blueprint $table) {
            $table->dropColumn('document_type_id');
            $table->renameColumn('original_documant_name', 'original_document_name');
            $table->string('signed_document_path')->change();
            $table->string('signed_document_name')->change();
            $table->integer('updated_by')->change();
            $table->integer('deleted_by')->change();
        });
    }
};

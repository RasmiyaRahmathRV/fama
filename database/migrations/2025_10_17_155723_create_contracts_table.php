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
        Schema::create('contract_types', function (Blueprint $table) {
            $table->id();
            $table->string('contract_type');
            $table->timestamps();
        });


        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('project_code');
            $table->integer('project_number');
            $table->Unsignedinteger('company_id');
            $table->Unsignedinteger('vendor_id');
            $table->Unsignedinteger('contract_type_id');
            $table->string('contact_person')->nullable();
            $table->string('contact_number')->nullable();
            $table->Unsignedinteger('area_id');
            $table->Unsignedinteger('locality_id');
            $table->Unsignedinteger('property_id');
            $table->boolean('is_vendor_contract_uploaded')->default(0);
            $table->boolean('is_scope_generated')->default(0);
            $table->integer('contract_status')->default(0)->comment('0-Pending, 1-Processing, 2-Approved, 3-Rejected');
            $table->boolean('is_aknowledgement_uploaded')->default(0);
            $table->boolean('is_cheque_copy_uploaded')->default(0);
            $table->Unsignedinteger('parent_contract_id')->nullable();
            $table->boolean('contract_renewal_status')->default(0)->comment('0-new, 1-renewed');
            $table->integer('renewal_count')->nullable();
            $table->date('renewal_date')->nullable();
            $table->integer('renewed_by')->nullable();
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->integer('approved_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('scope_generated_by')->nullable();
            $table->text('rejected_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_types');
        Schema::dropIfExists('contracts');
    }
};

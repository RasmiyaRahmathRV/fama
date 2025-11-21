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
        Schema::create('tenant_identities', function (Blueprint $table) {
            $table->id();
            $table->string('identity_type');
            $table->string('first_field_name');
            $table->string('first_field_id');
            $table->string('first_field_type');
            $table->string('first_field_label');
            $table->string('second_field_name');
            $table->string('second_field_id');
            $table->string('second_field_type');
            $table->string('second_field_label');
            $table->boolean('show_status');
            $table->timestamps();
        });
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('agreement_code');
            $table->UnsignedBiginteger('contract_id');
            $table->Unsignedinteger('company_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_in_months');
            $table->integer('duration_in_days')->nullable();
            $table->boolean('is_emirates_id_uploaded')->default(0);
            $table->boolean('is_passport_uploaded')->default(0);
            $table->boolean('is_visa_uploaded')->default(0);
            $table->boolean('is_signed_agreement_uploaded')->default(0);
            $table->boolean('is_trade_license_uploaded')->default(0);
            $table->integer('agreement_status')->default(0)->comment('0-Pending, 1-terminated');
            $table->date('terminated_date')->nullable();
            $table->text('terminated_reason')->nullable();
            $table->integer('terminated_by')->nullable();
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreements');
        Schema::dropIfExists('tenant_identities');
    }
};

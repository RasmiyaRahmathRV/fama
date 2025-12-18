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
        Schema::create('payout_batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_name');
            $table->integer('status')->default(1);
            $table->timestamps();
        });


        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('investor_code');
            $table->string('investor_name');
            $table->string('investor_mobile');
            $table->string('investor_email');
            $table->text('investor_address');
            $table->unsignedBigInteger('nationality_id');
            $table->unsignedBigInteger('country_of_residence');
            $table->unsignedBigInteger('payment_mode_id');
            $table->string('id_number');
            $table->string('passport_number');
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->unsignedBigInteger('payout_batch_id');
            $table->date('profit_release_date')->nullable();
            $table->integer('status')->default(0)->comment('0-inactive, 1-active');
            $table->integer('total_no_of_investments')->default(0);
            $table->decimal('total_invested_amount', 12, 2)->default(0);
            $table->decimal('total_profit_released', 12, 2)->default(0);
            $table->decimal('total_referal_commission_received', 12, 2)->default(0);
            $table->integer('total_terminated_investments')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('is_passport_uploaded')->default(0);
            $table->integer('is_supp_doc_uploaded')->default(0);
            $table->integer('is_ref_com_cont_uploaded')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investors');
        Schema::dropIfExists('payout_batches');
    }
};

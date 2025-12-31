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
        Schema::create('vendor_contract_templates', function (Blueprint $table) {
            $table->id();
            $table->text('template_name');
            $table->integer('version')->default(1);
            $table->integer('status')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();
        });


        Schema::create('contract_signature_dimensions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_template_id');
            $table->enum('page_type', ['odd', 'even'])->default('odd');
            $table->integer('x')->default(243);
            $table->integer('y')->default(40);
            $table->integer('width')->default(135);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_sign_dimensions_per_vendor');
    }
};

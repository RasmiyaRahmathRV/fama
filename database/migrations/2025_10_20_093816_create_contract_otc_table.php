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
        Schema::create('contract_otc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->decimal('cost_of_development', 8, 2);
            $table->decimal('cost_of_bed', 8, 2);
            $table->decimal('cost_of_matress', 8, 2);
            $table->decimal('appliances', 8, 2);
            $table->decimal('decoration', 8, 2);
            $table->decimal('dewa_deposit', 8, 2);
            $table->decimal('ejari', 8, 2);
            $table->decimal('cost_of_cabinets', 8, 2);
            $table->string('added_by');
            $table->string('updated_by');
            $table->string('deleted_by');
            $table->timestamps();

            $table->foreign('contract_id')
                ->references('id')->on('contracts')
                ->onDelete('cascade');


            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_otc');
    }
};

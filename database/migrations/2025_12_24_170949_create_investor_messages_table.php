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
        Schema::create('investor_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('message_setting_id');
            $table->integer('investor_id');
            $table->integer('investment_id')->nullable();
            $table->string('investor_mobile');
            $table->text('investor_message_body');
            $table->integer('send_status');
            $table->text('api_return');
            $table->integer('send_by');
            $table->date('send_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_messages');
    }
};

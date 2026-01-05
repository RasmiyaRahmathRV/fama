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
        Schema::create('whatsapp_messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('investor_id'); // link to investor
            $table->string('phone');                   // phone number
            $table->string('template_id')->nullable(); // WhatsApp template ID

            // JSON columns
            $table->json('variables')->nullable(); // template variables
            $table->json('payload')->nullable();   // full API payload
            $table->json('response')->nullable();  // API response

            $table->boolean('status')->default(0); // 0 = failed/skipped, 1 = success

            $table->timestamps();                  // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsap_messages');
    }
};

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
        Schema::create('burra_whats_app_messages', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number')->index();
            $table->text('message');
            $table->enum('type', ['incoming', 'outgoing']);
            $table->string('wp_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('burra_whats_app_messages');
    }
};

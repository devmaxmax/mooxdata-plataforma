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
        Schema::table('burra_orders', function (Blueprint $table) {
            $table->string('payment_receipt')->nullable()->after('payment_method');
            // Adding a timestamp for payment request to handle 30 min timeout accurately if strictly needed from "waiting payment" state
            // But created_at is likely sufficient if state is pending_payment.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('burra_orders', function (Blueprint $table) {
            $table->dropColumn('payment_receipt');
        });
    }
};

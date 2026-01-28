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
            $table->string('customer_name')->after('table_number')->nullable();
            $table->string('customer_address')->after('customer_name')->nullable();
            $table->string('customer_phone')->after('customer_address')->nullable();
            $table->text('customer_note')->after('customer_phone')->nullable();
            $table->string('payment_method')->after('customer_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('burra_orders', function (Blueprint $table) {
            $table->dropColumn(['customer_name', 'customer_address', 'customer_phone', 'customer_note', 'payment_method']);
        });
    }
};

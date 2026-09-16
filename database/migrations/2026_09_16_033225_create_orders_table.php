<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('order_number', 30)->unique();

            $table->decimal('total_amount', 15, 2);
            $table->decimal('shipping_cost', 15, 2)->default(0);

            $table->string('courier', 20)->nullable();

            $table->text('shipping_address');
            $table->string('shipping_city', 100);
            $table->string('shipping_district', 100);
            $table->string('shipping_postal_code', 5);

            $table->string('payment_method', 30);
            $table->string('payment_status', 30)->default('PENDING');

            $table->string('payment_proof')->nullable();
            $table->timestamp('payment_submitted_at')->nullable();
            $table->timestamp('payment_verified_at')->nullable();

            $table->string('order_status', 30)->default('PENDING');

            $table->string('tracking_number', 100)->nullable();

            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
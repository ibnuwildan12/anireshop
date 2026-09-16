<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->id();

            $table->string('courier', 20);
            $table->string('city', 100);
            $table->decimal('cost', 15, 2);

            $table->timestamps();

            $table->unique(['courier', 'city']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_rates');
    }
};
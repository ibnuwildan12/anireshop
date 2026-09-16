<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            $table->string('name', 150);
            $table->string('slug', 170)->unique();
            $table->text('description')->nullable();

            $table->decimal('price', 15, 2);
            $table->unsignedInteger('stock')->default(0);
            $table->unsignedInteger('reserved_stock')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
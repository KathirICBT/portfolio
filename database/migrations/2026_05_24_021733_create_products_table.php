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
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->string('product_name');

            $table->text('description')->nullable();

            $table->string('product_number')->unique();

            // Category Relationship
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade');

            // Product Price
            $table->decimal('price', 10, 2);

            // Quantity
            $table->integer('quantity');

            // Unit Type
            $table->string('unit_type')->nullable();

            // Unit Value
            $table->decimal('unit_value', 10, 2)->nullable();

            // Product Image
            $table->string('image')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
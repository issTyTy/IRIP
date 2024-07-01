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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('order_id'); // Foreign key reference to Orders Table
            $table->unsignedBigInteger('product_id'); // Foreign key reference to Products Table
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2); // Example: 99.99
            $table->timestamps(); // Created at and updated at timestamps
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

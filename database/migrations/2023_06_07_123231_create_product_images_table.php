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
        Schema::create('product_images', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id'); // Foreign key to products table
            $table->string('file_path'); // The path to where the image is stored
            $table->string('alt_text')->nullable(); // Alt text for the image (for accessibility)
            $table->timestamps();

            $table->foreign('product_id') // Define the foreign key constraint
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};

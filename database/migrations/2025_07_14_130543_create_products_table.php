<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                  ->constrained('product_categories')
                  ->onDelete('cascade');

            $table->string('product_name');
            $table->string('product_size');
            $table->text('product_description');
            $table->text('product_technical_specifications_information');
            $table->string('product_main_image')->nullable();
            $table->string('product_image_1')->nullable();
            $table->string('product_image_2')->nullable();
            $table->string('product_image_3')->nullable();
            $table->json('related_products')->nullable();

            $table->json('features')->nullable();
            $table->string('breadcrumb_name')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->enum('status', ['Active', 'Inactive'])->default('Active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}

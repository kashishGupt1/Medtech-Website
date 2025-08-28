<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('blog_name');
            $table->date('blog_date');
            $table->string('blog_location');
            $table->longText('blog_description');
            $table->string('blog_main_image')->nullable();
            $table->json('blog_images')->nullable();
            $table->string('breadcrumb_name');
            $table->longText('breadcrumb_description');
            $table->string('breadcrumb_photo')->nullable();
            $table->string('meta_keyword');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

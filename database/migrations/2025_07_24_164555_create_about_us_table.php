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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('main_image')->nullable();
            $table->text('we_description')->nullable();
    
            $table->string('v_title')->nullable();
            $table->text('v_description')->nullable();
            $table->string('m_title')->nullable();
            $table->text('m_description')->nullable();
            
            $table->string('why_choose_title')->nullable();
            $table->text('why_choose_description')->nullable();
    
            $table->json('why_choose_cards')->nullable(); 
    
            $table->string('breadcrumb_name')->nullable();
            $table->text('breadcrumb_description')->nullable();
            $table->string('breadcrumb_photo')->nullable();
    
            $table->string('meta_keyword')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
    
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};

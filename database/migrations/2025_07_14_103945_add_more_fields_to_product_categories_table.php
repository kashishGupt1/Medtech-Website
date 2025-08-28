<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->string('category_image')->nullable();
            $table->string('breadcrumb_name')->nullable();
            $table->text('breadcrumb_description')->nullable();
            $table->string('breadcrumb_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn([
                'category_image',
                'breadcrumb_name',
                'breadcrumb_description',
                'breadcrumb_image'
            ]);
        });
    }
};

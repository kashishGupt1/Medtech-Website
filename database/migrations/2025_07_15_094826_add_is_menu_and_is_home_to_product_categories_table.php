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
        Schema::table('product_categories', function (Blueprint $table) {
            $table->boolean('is_menu')->default(0);
            $table->boolean('is_home')->default(0);
        });
    }

    public function down()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn(['is_menu', 'is_home']);
        });
    }
};

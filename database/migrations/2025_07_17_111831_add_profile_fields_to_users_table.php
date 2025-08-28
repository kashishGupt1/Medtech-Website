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
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_logo')->nullable();
            $table->string('contact_no1');
            $table->string('contact_no2')->nullable();
            $table->text('address');
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('linkedin_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'company_logo',
                'contact_no1',
                'contact_no2',
                'address',
                'facebook_link',
                'twitter_link',
                'youtube_link',
                'linkedin_link'
            ]);
        });
    }
};

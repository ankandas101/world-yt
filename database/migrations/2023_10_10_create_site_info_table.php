<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_infos', function (Blueprint $table) {
            $table->id();
            $table->string('site_name'); // সাইটের নাম
            $table->string('site_tagline')->nullable(); // স্লোগান / ছোট ট্যাগলাইন
            $table->string('site_logo')->nullable(); // Logo Image URL/Path
            $table->string('site_favicon')->nullable(); // Favicon Icon
            $table->string('site_primary_color')->nullable(); // Primary Theme Color (HEX code)
            $table->string('site_secondary_color')->nullable(); // Secondary Theme Color
            $table->string('default_og_image')->nullable(); // Default image for social share
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_info');
    }
};
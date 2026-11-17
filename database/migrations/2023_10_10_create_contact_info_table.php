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
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable(); // Official contact email
            $table->string('phone')->nullable(); // Primary phone number
            $table->string('phone2')->nullable(); // Secondary phone number
            $table->string('whatsapp')->nullable(); // WhatsApp number
            $table->text('address')->nullable(); // Physical address
            $table->text('map_embed')->nullable(); // Google Maps embed code
            $table->string('fb_url')->nullable(); // Facebook Messenger link
            $table->string('linkedin_url')->nullable(); // LinkedIn URL
            $table->string('twitter_url')->nullable(); // Twitter URL
            $table->string('telegram_url')->nullable(); // Telegram URL
            $table->timestamps();
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_info');
    }
};
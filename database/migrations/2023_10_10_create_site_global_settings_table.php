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
        Schema::create('site_global_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('maintenance_mode')->default(false); // Enable/Disable site maintenance
            $table->text('maintenance_message')->nullable(); // Custom maintenance message
            $table->boolean('enable_recaptcha')->default(false); // reCAPTCHA enable/disable
            $table->boolean('enable_email')->default(false); // Email enable/disable
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
        Schema::dropIfExists('site_global_settings');
    }
};
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
        Schema::create('site_seos', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->nullable(); // Default meta title
            $table->text('meta_description')->nullable(); // Default meta description
            $table->string('meta_keywords')->nullable(); // Comma-separated keywords
            $table->string('site_logo_alt_text')->nullable(); // Alt text for logo image
            $table->string('site_tagline_meta')->nullable(); // Tagline for SEO meta tag
            $table->string('google_analytics_id')->nullable(); // Analytics Tracking ID
            $table->string('google_search_console_verification')->nullable(); // Search Console verification code
            $table->text('robots_txt')->nullable(); // Custom robots.txt content
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
        Schema::dropIfExists('site_seo');
    }
};
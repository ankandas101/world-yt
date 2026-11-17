<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Ad title (internal use)
            $table->string('client_name')->nullable(); // Who is giving ad
            $table->string('ad_type')->default('image'); // image, video, text, html
            $table->string('ad_content')->nullable(); // image URL/video URL/code etc
            // $table->text('ad_code')->nullable(); // For custom HTML/JS Ads (adsense etc.)
            $table->string('target_url')->nullable(); // When click, go to this URL
            $table->string('ad_position'); // header, sidebar, footer, in-post, popup
            $table->dateTime('start_date')->nullable(); // When ad starts
            $table->dateTime('end_date')->nullable(); // When ad ends
            $table->boolean('is_active')->default(true); // Enable/Disable ad
            $table->unsignedBigInteger('click_count')->default(0); // track ad clicks
            $table->unsignedBigInteger('view_count')->default(0); // track ad views
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};

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
        Schema::create('page_blog_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('posts_per_page')->default(10); // Blog posts per page
            $table->boolean('enable_comments')->default(true); // Comments enable/disable
            $table->string('default_post_image')->nullable(); // Default image for blog post
            $table->boolean('show_related_posts')->default(true); // Show related posts
            $table->boolean('show_author_info')->default(true); // Show/hide author bio
            $table->boolean('show_social_share_buttons')->default(true); // Enable social share buttons
            $table->foreignId('check_also_blog')->nullable()->constrained('blogs')->cascadeOnDelete()->cascadeOnUpdate(); // Enable social share buttons
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
        Schema::dropIfExists('page_blog_details');
    }
};

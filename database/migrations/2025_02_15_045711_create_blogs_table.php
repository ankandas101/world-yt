<?php

use App\Models\Category;
use App\Models\RobustSeo;
use App\Models\User;
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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            //blog infos
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->string('video_embed')->nullable();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('reading_time')->default('3 minutes');
            $table->boolean('is_published')->default(false);


            //Social links
            $table->string('fb_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('telegram_url')->nullable();

            //Query paramenter
            $table->unsignedBigInteger('view_count')->default(1);
            $table->boolean('is_slider')->default(false);
            $table->boolean('is_trending')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

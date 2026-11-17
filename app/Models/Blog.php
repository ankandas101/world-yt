<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Spatie\Sitemap\SitemapGenerator;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'image_alt_text',
        'video_embed',
        'category_id',
        'user_id',
        'reading_time',
        'is_published',

        // social link
        'fb_url',
        'linkedin_url',
        'twitter_url',
        'telegram_url',

        //Query paramenter
        'is_slider',
        'is_trending',
        'view_count',
    ];
    protected $appends = ['created_at_date', 'created_at_human', 'content10'];
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function robust_seo()
    {
        return $this->belongsTo(RobustSeo::class, 'blog_id', 'id');
    }
    public function getCreatedAtDateAttribute()
    {
        return $this->created_at ? $this->created_at->format('d-m-Y') : null;
    }

    public function getCreatedAtHumanAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }

    public function getContent10Attribute()
    {
        return str($this->content)->words(10);
    }
    public static function booted()
    {
         // Global Scope: শুধুমাত্র published blog আসবে
        //  static::addGlobalScope('published', function (Builder $builder) {
        //     $builder->where('is_published', true);
        // });

        static::saved(function ($blog) {
            // Inside your saved() callback
            // dispatch(function () {
            //     SitemapGenerator::create(env('APP_URL'))
            //         ->writeToFile(public_path('sitemap.xml'));
            // })->afterResponse(); // Wait until response is sent

            Cache::forget('homepage_data');

        });
        static::deleted(fn () => Cache::forget('homepage_data'));
    }
}

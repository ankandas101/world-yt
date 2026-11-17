<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Spatie\Sitemap\SitemapGenerator;

class RobustSeo extends Model
{
    use SoftDeletes;

    protected $fillable =  ['blog_id','meta_title','meta_description','focus_keywords','meta_tags','conical_url','og_title','og_description','no_index'];

    public function blog(){
        return $this->belongsTo(Blog::class,'blog_id','id');
    }

    public static function booted()
    {
        static::saved(function ($blogSeo) {
            Blog::where('id',$blogSeo->blog_id)->update([
                'is_published' => true
            ]);
            // saved() callback
            dispatch(function () {
                SitemapGenerator::create(env('APP_URL'))
                    ->writeToFile(public_path('sitemap.xml'));
            })->afterResponse(); // Wait until response is sent

            Cache::forget('homepage_data');

        });
        static::deleted(fn () => Cache::forget('homepage_data'));
    }
}

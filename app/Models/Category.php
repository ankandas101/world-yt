<?php

namespace App\Models;

use App\Service\CategoryManager;
use App\Service\DBdataCached;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sitemap\SitemapGenerator;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','slug','description','parent_id','order','status'];

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id')->withoutTrashed();
    }

    public function submenu(){
        return $this->hasMany(Category::class,'parent_id','id')->withoutTrashed();
    }

    public function blogs(){
        return $this->hasMany(Blog::class,'category_id','id')->withoutTrashed();
    }

    public static function booted(){
        static::saved(function ($category) {
            //refresh catch catgory
        //    (new CategoryManager())->refresh();

           // site map genereator
           dispatch(function () {
                SitemapGenerator::create('https://msnworld.net')
                ->writeToFile(public_path('sitemap.xml'));
            })->afterResponse(); // Wait until response is sent
        });

        static::deleted(function ($category) {
            // (new CategoryManager())->refresh();
        });
    }
}

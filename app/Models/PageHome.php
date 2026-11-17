<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PageHome extends Model
{
    protected $fillable = ['category_id', 'status','order'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id', 'category_id')->limit(5);
    }
    public function blogsPaginated()
    {
       return Blog::with(['category','author'])->where('category_id',$this->category_id)->paginate(5);
        // return $this->hasMany(Blog::class, 'category_id', 'category_id')->paginate(5);
    }

    public static function booted()
    {
        static::saved(fn () => Cache::forget('homepage_data'));
        static::deleted(fn () => Cache::forget('homepage_data'));
    }

}

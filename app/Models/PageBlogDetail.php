<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageBlogDetail extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'page_blog_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'posts_per_page',
        'enable_comments',
        'default_post_image',
        'show_related_posts',
        'show_author_info',
        'show_social_share_buttons',
    ];

    public function pop_up_blog()
    {
        return $this->belongsTo(Blog::class,'check_also_blog','id');
    }
}

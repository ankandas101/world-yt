<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','client_name','ad_type','ad_content','target_url','ad_position','start_date','end_date','is_active','click_count','view_count'];
}

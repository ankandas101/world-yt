<?php

namespace App\Models;

use App\Service\DBdataCached;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_logo',
        'site_favicon',
        'site_primary_color',
        'site_secondary_color',
        'default_og_image',
    ];


    public static function booted(){
        static::saved(function ($siteInfo) {
           (DBdataCached::make())->refreshSiteInfo();
        });

    }
}

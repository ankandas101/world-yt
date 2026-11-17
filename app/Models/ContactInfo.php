<?php

namespace App\Models;

use App\Service\DBdataCached;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactInfo extends Model
{
    use HasFactory, SoftDeletes;

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
        'email',
        'phone',
        'phone2',
        'whatsapp',
        'address',
        'map_embed',
        'fb_url',
        'linkedin_url',
        'twitter_url',
        'telegram_url',
    ];

    public static function booted(){
        static::saved(function ($category) {
            (DBdataCached::make())  ->refreshSiteContact();
        });

    }
}

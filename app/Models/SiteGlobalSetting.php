<?php

namespace App\Models;

use App\Service\DBdataCached;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteGlobalSetting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'site_global_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'maintenance_mode',
        'maintenance_message',
        'enable_recaptcha',
        'enable_email',
    ];

    public static function booted(){
        static::saved(function ($category) {
           (new DBdataCached())->refreshSiteGlobal();
        });

    }
}

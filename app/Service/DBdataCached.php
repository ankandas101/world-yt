<?php
namespace App\Service;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DBdataCached{

    //site Setting infos
    public $site_info;

    //site contact infos
    public $site_contact;

    //site global setting
    public $site_global;

    //site seo setting
    public $site_seo;

    private static $instance = null;
    private function __construct(){

        //get site info data
        $this->getSiteInfo();

        //get site contact data
        $this->getSiteContact();

        //get site global data
        $this->getSiteGlobal();

        //get site seo data
        $this->getSiteSeo();
    }

    public static function make(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getSiteInfo(){
        $site_info = Cache::get('site_info');
        $site_info ? ($this->site_info = $site_info) : $this->refreshSiteInfo();
    }
    public function getSiteContact(){
        $site_contact = Cache::get('site_contact');
        $site_contact ? ($this->site_contact = $site_contact) : $this->refreshSiteContact();
    }
    public function getSiteGlobal(){
        $site_global = Cache::get('site_global');
        $site_global ? ($this->site_global = $site_global) : $this->refreshSiteGlobal();
    }

    public function refreshSiteInfo(){
        $site_info = DB::table('site_infos')->first();
        Cache::put('site_info',$site_info);
        $this->site_info = $site_info;
    }
    public function refreshSiteContact(){
        $site_contact = DB::table('contact_infos')->first();
        Cache::put('site_contact',$site_contact);
        $this->site_contact = $site_contact;
    }
    public function refreshSiteGlobal(){
        $site_global = DB::table('site_global_settings')->first();
        Cache::put('site_global',$site_global);
        $this->site_global = $site_global;
    }
    public function getSiteSeo(){
        $site_seo = Cache::get('site_seos');
        $site_seo ? ($this->site_seo = $site_seo) : $this->refreshSiteSeo();
    }
    public function refreshSiteSeo(){
        $site_seo = DB::table('site_seos')->first();
        Cache::put('site_seo',$site_seo);
        $this->site_seo = $site_seo;
    }

    public function refreshAll(){
        $this->refreshSiteInfo();
        $this->refreshSiteContact();
        $this->refreshSiteGlobal();
        $this->refreshSiteSeo();
    }
}

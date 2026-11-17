<?php
namespace App\Service;

use Illuminate\Support\Facades\Storage;

class ImageManager{
    public $image_path;
    public $type;
    public $return_path;
    public function __construct($image_path,$type){
        $this->image_path = $image_path;
        $this->type = $type;
        $this->return_path = $this->get();
    }


    public function get(){
        if($this->image_path == null){
            return $this->defaultPath();
        }
       if(Storage::disk('public')->exists($this->image_path)){
           if (substr($this->image_path, 0, 1) == '/') {
                $this->image_path = substr($this->image_path, 1);
           }

           return '/storage/'.$this->image_path;
       }

       return $this->defaultPath();
    }

    public function defaultPath(){
        if($this->type == 'user'){
            return '/asset/images/default/default-profile.avif';
        }
        if($this->type == 'blog'){
            return '/asset/images/default/fruits.avif';
        }
        if($this->type == 'logo'){
            return '/asset/images/default/logo/270x270.png';
        }
        if($this->type == 'favicon'){
            return '/asset/images/default/logo/32x32.png';
        }
        return '/asset/images/default/d1.jpg';
    }

}

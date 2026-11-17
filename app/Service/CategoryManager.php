<?php
namespace App\Service;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryManager{
    public $categories;
    public function __construct(){
        $this->categories = $this->get();
    }
    public function refresh(){
        $categories = Category::with('blogs')
                            ->where('parent_id', null)
                            ->where('status', 1)
                            ->orderBy('order')
                            ->get();
        Cache::put('categories',$categories);
        return $categories;
    }
    public function get(){
        $categories = Cache::get('categories');
        $categories = $categories ? $categories : $this->refresh();
        return  $categories;
    }

}

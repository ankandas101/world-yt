<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class SidebarCategoryList extends Component
{
    // public $categories;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // $this->categories = categories();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.sidebar-category-list');
    }
}

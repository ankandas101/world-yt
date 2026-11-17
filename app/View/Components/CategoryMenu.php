<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class CategoryMenu extends Component
{
    // public $categories;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Fetch top-level categories with their subcategories, only active ones, ordered
        // $this->categories = categories()->take(9);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-menu');
    }
}

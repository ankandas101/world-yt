<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $cached_db_data = dbDataCached();
        // $categories = categories();
        $categories = Category::with(['blogs' => function ($query) {
                                $query->limit(6)
                                    ->orderBy('created_at', 'desc'); // অথবা যেকোনো order
                            }])
                            ->where('parent_id', null)
                            ->where('status', 1)
                            ->orderBy('order')
                            ->get();
        view()->share('cdd',$cached_db_data);
        view()->share('categories',$categories);

    }
}

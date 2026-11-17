<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\PageBlogDetail;
use App\Models\PageHome;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{

    public function homePage()
    {
        // Cache::forget('homepage_data');
        // $home_page_data = Cache::rememberForever('homepage_data', function () {
            $data = [];

            $data['trendings'] = Blog::with('category')
                ->where('is_trending',true)
                ->where('is_published', true)
                ->latest()
                ->limit(3)->get();

            $data['sliders'] = Blog::with('category')
                ->where('is_slider',true)
                ->where('is_published', true)
                ->latest()
                ->limit(3)->get();

            $data['latest_blogs'] = Blog::with('category')
                ->limit(21)
                ->where('is_published', true)
                ->latest()
                ->get();

            $gaming_category = Category::where('slug','gaming')->first();
            $tech_category = Category::where('slug','tech')->first();
            $entertainment_category = Category::where('slug','entertainments')->first();
            $sport_category = Category::where('slug','sports')->first();

            $data['gaming_blogs'] = Blog::with('category')
                ->where('category_id',$gaming_category?->id)
                ->where('is_published', true)
                ->limit(8)
                ->latest()
                ->get();

            $data['techs'] = Blog::with('category')
                ->where('category_id',$tech_category?->id)
                ->where('is_published', true)
                ->limit(8)
                ->latest()
                ->get();

            $data['entertainment_blogs'] = Blog::with('category')
                ->where('category_id',$entertainment_category?->id)
                ->where('is_published', true)
                ->limit(8)
                ->latest()
                ->get();

            $data['sports_blogs'] = Blog::with('category')
                ->where('category_id',$sport_category?->id)
                ->where('is_published', true)
                ->limit(8)
                ->latest()
                ->get();



        //     return $data;
        // });


        // dd($home_page_data);
        return view('frontend.pages.home', $data);
    }



    public function blogDetail($slug)
    {
        // dd($slug);
        $pageBlogDetail = PageBlogDetail::first();
        $n['blog'] = Blog::with('category', 'robust_seo')
            ->where('slug', $slug)
            // ->where('is_published', true)
            ->first();

        if(!$n['blog']){
            return back();
        }

        $n['related_blogs'] = Blog::with('category', 'robust_seo', 'author')
            ->where('is_published', true)
            ->where('category_id', $n['blog']?->category_id)
            ->where('id', '!=', $n['blog']?->id)
            ->take($pageBlogDetail?->posts_per_page ?: 10)
            ->get();

        $n['page_blog_details_setting'] = $pageBlogDetail;
        return view('frontend.pages.blog-details', $n);
    }

    public function catSubcatWiseBlog($cat_slug)
    {
        $category = Category::with('blogs.author', 'blogs.robust_seo')
            ->where('slug', $cat_slug)
            ->first();

        $n['blogs'] = Blog::where('category_id',$category->id)
            ->where('is_published', true)
            ->paginate(10);

        $n['category'] = $category;

        return view('frontend.pages.cat-subcat-blog', $n);
    }
    public function authorPage($username)
    {
        $n['author'] = User::where('username', $username)
            ->first();

        $n['blogs'] = Blog::with('category')
            ->where('user_id',$n['author']->id)
            ->where('is_published', true)
            ->paginate(10);
        if(!$n['author']){
            return back();
        }
        return view('frontend.pages.author-page', $n);
    }

    public function contactUsPage()
    {
        return view('frontend.pages.contact-us');
    }
    public function contactUsPost(ContactUsRequest $request)
    {
        $data = $request->validated();
        $insert = ContactUs::create($data);
        if ($insert) {
            return redirect()->back()->with('success', 'Message sent successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function privacyPolicyPage()
    {
        return view('frontend.pages.privacy-policy');
    }
    public function writeForUs()
    {
        return view('frontend.pages.write-for-us');
    }
    public function aboutUsPage()
    {
        return view('frontend.pages.about-us');
    }

    public function recentBlogs(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);

        $blogs = Blog::orderBy('created_at', 'desc')
            ->where('is_published', true)
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'data' => $blogs->items(),
            'current_page' => $blogs->currentPage(),
            'last_page' => $blogs->lastPage(),
        ]);
    }

    public function blogSearch(Request $request)
    {
        // dd($request->all());
        $query = $request->text;
        $n['results'] = Blog::with('category')
            ->where('is_published', true)
            ->where('title', 'like', "%$query%")
            ->paginate(12);
        $n['search_text'] = $query;
            return view('frontend.pages.search-page', $n);
    }



}

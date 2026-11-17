@php
    $db_data_cached = $cdd;
    $og_url = url()->current();
    $og_site_name = $db_data_cached->site_seo?->meta_title;
    $og_title = $db_data_cached->site_info?->site_tagline;
    $og_description = $db_data_cached->site_seo?->meta_description;
    $og_img = asset(photo($db_data_cached->site_info?->site_logo, 'logo'));
    $og_keywords = $db_data_cached->site_seo?->meta_keywords;
@endphp


@extends('frontend.layout.app')

@push('title')
    {{ $category?->name ?: 'Category' }}
@endpush


@push('meta_seo')
    {{-- Global Seo Content --}}
    <meta name="description" content="{{ $og_description }}" />
    <link rel="canonical" href="{{ $og_url }}" />
    <meta name="keywords" content="{{ $og_keywords }}">

    {{-- Blog Open Graph --}}
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $og_url }}" />
    <meta property="og:site_name" content="{{ $og_site_name }}" />
    <meta property="og:title" content="{{ $category?->name ?: 'Category' }}" />
    <meta property="og:description" content="{{ $og_description }}" />
    <meta property="og:image" content="{{ $og_img }}" />
    <meta property="og:image:alt" content="{{ $og_site_name }}">
    <meta property="og:locale" content="en_US" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $category->name }}" />
    <meta name="twitter:description" content="{{ $og_description }}" />
    <meta name="twitter:image" content="{{ $og_img }}" />
@endpush


@push('seo_schema')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [
                {
                    "@type": "CollectionPage",
                    "name": "{{ $category->name }}",
                    "description": "{{ $category->description ?? 'Latest posts in ' . $category->name }}",
                    "url": "{{ url()->current() }}"
                },
                {
                    "@type": "ItemList",
                    "itemListElement": [
                        @foreach($category?->blogs as $index => $blog)
                        {
                            "@type": "ListItem",
                            "position": {{ $index + 1 }},
                            "url": "{{ route('blog_detail', $blog->slug) }}"
                        }@if(!$loop->last),@endif
                        @endforeach
                    ]
                },
                {
                    "@type": "BreadcrumbList",
                    "itemListElement": [
                        {
                            "@type": "ListItem",
                            "position": 1,
                            "name": "Home",
                            "item": "{{ url('/') }}"
                        },
                        {
                            "@type": "ListItem",
                            "position": 2,
                            "name": "{{ $category->name }}",
                            "item": "{{ url()->current() }}"
                        }
                    ]
                }
            ]
        }
    </script>
@endpush


@section('content')
    <div id="mvp-main-body-wrap" class="left relative" style="margin-top: 0px;">
        <div class="mvp-main-blog-wrap left relative">
            <div class="mvp-main-box">
                <div class="mvp-main-blog-cont left relative">
                    <div class="mvp-main-blog-out left relative">
                        <div class="mvp-main-blog-in">
                            <div class="mvp-main-blog-body left relative">


                                <div id="mvp-cat-feat-wrap" class="left relative">
                                    @php
                                        $first_blog = $blogs->splice(-1)->first();
                                    @endphp
                                    @if ($first_blog)
                                        <div class="mvp-widget-feat2-left left relative mvp-widget-feat2-left-alt">
                                            <a href="{{route('blog_detail', $first_blog?->slug)}}"
                                                rel="bookmark">
                                                <div class="mvp-widget-feat2-left-cont left relative">
                                                    <div class="mvp-feat1-feat-img left relative">
                                                        <img width="560" height="600" loading="lazy"
                                                            src="{{ photo($first_blog?->image,'blog') }}"
                                                            class="attachment-mvp-port-thumb size-mvp-port-thumb wp-post-image"
                                                            alt="{{$first_blog?->title}}"
                                                            decoding="async">
                                                    </div><!--mvp-feat1-feat-img-->
                                                    <div class="mvp-feat1-feat-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">{{$category?->name}}</span><span
                                                                class="mvp-cd-date left relative">{{ $first_blog->created_at->diffForHumans() }}</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2 class="mvp-stand-title">
                                                            {{$first_blog?->title}}
                                                        </h2>
                                                        <p>
                                                            {{str(strip_tags($first_blog?->content))->words(6)}}
                                                        </p>
                                                    </div><!--mvp-feat1-feat-text-->
                                                </div><!--mvp-widget-feat2-left-cont-->
                                            </a>
                                        </div><!--mvp-widget-feat2-left-->
                                    @endif
                                    <div class="mvp-widget-feat2-right left relative">
                                        <h1 class="mvp-feat1-pop-head"><span class="mvp-feat1-pop-head">{{$category->name}}</span></h1>
                                        <div class="mvp-widget-feat2-right-main left relative">

                                            @foreach ($blogs->splice(-2) as $blog2)
                                                <a href="{{route('blog_detail',$blog2->slug)}}"
                                                    rel="bookmark">
                                                    <div class="mvp-widget-feat2-right-cont left relative">
                                                        <div class="mvp-widget-feat2-right-img left relative">
                                                            <img width="400" height="240"
                                                                src="{{photo($blog2->image,'blog')}}"
                                                                class="mvp-reg-img lazy wp-post-image" alt="{{$blog2->title}}" loading="lazy"
                                                                decoding="async"
                                                                sizes="(max-width: 400px) 100vw, 400px">
                                                            <img width="80"
                                                                height="80"
                                                                src="{{photo($blog2->image,'blog')}}"
                                                                class="mvp-mob-img lazy wp-post-image" alt="{{$blog2->title}}" loading="lazy"
                                                                decoding="async"
                                                                sizes="(max-width: 80px) 100vw, 80px">
                                                        </div><!--mvp-widget-feat2-right-img-->
                                                        <div class="mvp-widget-feat2-right-text left relative">
                                                            <div class="mvp-cat-date-wrap left relative">
                                                                <span class="mvp-cd-cat left relative">{{$category->name}}</span><span
                                                                    class="mvp-cd-date left relative">{{$blog2->created_at->diffForHumans()}}</span>
                                                            </div><!--mvp-cat-date-wrap-->
                                                            <h2>
                                                                {{ str($blog2->title)->words(8)}}
                                                            </h2>
                                                        </div><!--mvp-widget-feat2-right-text-->
                                                    </div><!--mvp-widget-feat2-right-cont-->
                                                </a>
                                            @endforeach
                                        </div><!--mvp-widget-feat2-right-main-->
                                    </div><!--mvp-widget-feat2-right-->
                                </div><!--mvp-cat-feat-wrap-->

                                <ul class="mvp-blog-story-list left relative infinite-content">
                                    @foreach ($blogs->splice(-1) as $shortblog)
                                        <li class="mvp-blog-story-wrap left relative infinite-post">
                                            <a href="{{route('blog_detail',$shortblog->slug)}}"
                                                rel="bookmark">
                                                <div class="mvp-blog-story-text left relative">
                                                    <div class="mvp-cat-date-wrap left relative">
                                                        <span class="mvp-cd-cat left relative">{{$category->name}}</span><span
                                                            class="mvp-cd-date left relative">{{$shortblog->created_at->diffForHumans()}}</span>
                                                    </div><!--mvp-cat-date-wrap-->
                                                    <h2>{{$shortblog->title}}</h2>
                                                    <p>
                                                        {{ str(strip_tags($shortblog->content))->words(25)}}
                                                    </p>
                                                </div><!--mvp-blog-story-text-->
                                            </a>
                                        </li><!--mvp-blog-story-wrap-->
                                    @endforeach

                                    @foreach ($blogs->splice(-3) as $blog3)

                                        <li class="mvp-blog-story-wrap left relative infinite-post">
                                            <a href="{{route('blog_detail',$blog3->slug)}}"
                                                rel="bookmark">
                                                <div class="mvp-blog-story-out relative">
                                                    <div class="mvp-blog-story-img left relative">
                                                        <img width="650" height="600"
                                                            src="{{photo($blog3->image,'blog')}}"
                                                            class="mvp-big-img wp-post-image" alt="{{$blog3->title}}" decoding="async"
                                                            loading="lazy">
                                                        <img width="400" height="240"
                                                            src="{{photo($blog3->image,'blog')}}"
                                                            class="mvp-reg-img wp-post-image" alt="{{$blog3->title}}" decoding="async"
                                                            loading="lazy"
                                                            sizes="auto, (max-width: 400px) 100vw, 400px">
                                                        <img width="80"
                                                            height="80"
                                                            src="{{photo($blog3->image,'blog')}}"
                                                            class="mvp-mob-img wp-post-image" alt="{{$blog3->title}}" decoding="async"
                                                            loading="lazy"
                                                            sizes="auto, (max-width: 80px) 100vw, 80px">
                                                    </div><!--mvp-blog-story-img-->
                                                    <div class="mvp-blog-story-in">
                                                        <div class="mvp-blog-story-text left relative">
                                                            <div class="mvp-cat-date-wrap left relative">
                                                                <span class="mvp-cd-cat left relative">{{$category->name}}</span><span
                                                                    class="mvp-cd-date left relative">{{$blog3->created_at->diffForHumans()}}</span>
                                                            </div><!--mvp-cat-date-wrap-->
                                                            <h2>{{$blog3->title}}</h2>
                                                            <p>
                                                                {{ str(strip_tags($blog3->content))->words(25)}}
                                                            </p>
                                                        </div><!--mvp-blog-story-text-->
                                                    </div><!--mvp-blog-story-in-->
                                                </div><!--mvp-blog-story-out-->
                                            </a>
                                        </li><!--mvp-blog-story-wrap-->
                                    @endforeach

                                    @foreach ($blogs->splice(-1) as $medium_blog)
                                        <li class="mvp-blog-story-wrap left relative infinite-post">
                                            <a href="{{route('blog_detail',$medium_blog->slug)}}"
                                                rel="bookmark">
                                                <div class="mvp-blog-story-out relative">
                                                    <div class="mvp-blog-story-img left relative">
                                                        <img width="1000" height="600"
                                                            src="{{photo($medium_blog->image,'blog')}}"
                                                            class="mvp-big-img wp-post-image"
                                                            alt="{{$medium_blog->title}}"
                                                            decoding="async" loading="lazy"
                                                            sizes="auto, (max-width: 1000px) 100vw, 1000px">
                                                        <img
                                                            width="400" height="240"
                                                            src="{{photo($medium_blog->image,'blog')}}"
                                                            class="mvp-reg-img wp-post-image"
                                                            alt="{{$medium_blog->title}}"
                                                            decoding="async" loading="lazy"
                                                            sizes="auto, (max-width: 400px) 100vw, 400px">
                                                        <img width="80"
                                                            height="80"
                                                            src="{{photo($medium_blog->image,'blog')}}"
                                                            class="mvp-mob-img wp-post-image"
                                                            alt="{{$medium_blog->title}}"
                                                            decoding="async" loading="lazy"
                                                            sizes="auto, (max-width: 80px) 100vw, 80px">
                                                    </div><!--mvp-blog-story-img-->
                                                    <div class="mvp-blog-story-in">
                                                        <div class="mvp-blog-story-text left relative">
                                                            <div class="mvp-cat-date-wrap left relative">
                                                                <span class="mvp-cd-cat left relative">{{$category->name}}</span><span
                                                                    class="mvp-cd-date left relative">{{$medium_blog->created_at->diffForHumans()}}</span>
                                                            </div><!--mvp-cat-date-wrap-->
                                                            <h2>
                                                                {{$medium_blog->name}}
                                                            </h2>
                                                            <p>
                                                                {{ str(strip_tags($medium_blog->content))->words(25)}}
                                                            </p>
                                                        </div><!--mvp-blog-story-text-->
                                                    </div><!--mvp-blog-story-in-->
                                                </div><!--mvp-blog-story-out-->
                                            </a>
                                        </li><!--mvp-blog-story-wrap-->
                                    @endforeach

                                    @foreach ($blogs->splice(-3) as $last_blog)
                                        <li class="mvp-blog-story-wrap left relative infinite-post">
                                            <a href="{{route('blog_detail',$last_blog->slug)}}"
                                                rel="bookmark">
                                                <div class="mvp-blog-story-out relative">
                                                    <div class="mvp-blog-story-img left relative">
                                                        <img width="1000" height="600"
                                                            src="{{ photo($last_blog->image,'blog')}}"
                                                            class="mvp-big-img wp-post-image" alt="{{$last_blog->title}}" decoding="async"
                                                            loading="lazy"
                                                            sizes="auto, (max-width: 1000px) 100vw, 1000px">
                                                        <img
                                                            width="400" height="240"
                                                            src="{{ photo($last_blog->image,'blog')}}"
                                                            class="mvp-reg-img wp-post-image" alt="{{$last_blog->title}}" decoding="async"
                                                            loading="lazy"
                                                            sizes="auto, (max-width: 400px) 100vw, 400px">
                                                        <img width="80"
                                                            height="80"
                                                            src="{{ photo($last_blog->image,'blog')}}"
                                                            class="mvp-mob-img wp-post-image" alt="{{$last_blog->title}}" decoding="async"
                                                            loading="lazy"
                                                            sizes="auto, (max-width: 80px) 100vw, 80px">
                                                    </div><!--mvp-blog-story-img-->
                                                    <div class="mvp-blog-story-in">
                                                        <div class="mvp-blog-story-text left relative">
                                                            <div class="mvp-cat-date-wrap left relative">
                                                                <span class="mvp-cd-cat left relative">{{$category->name}}</span><span
                                                                    class="mvp-cd-date left relative">{{$last_blog->created_at->diffForHumans()}}</span>
                                                            </div><!--mvp-cat-date-wrap-->
                                                            <h2>
                                                                {{$last_blog->title}}
                                                            </h2>
                                                            <p>
                                                                {{ str(strip_tags($last_blog->content))->words(25)}}
                                                            </p>
                                                        </div><!--mvp-blog-story-text-->
                                                    </div><!--mvp-blog-story-in-->
                                                </div><!--mvp-blog-story-out-->
                                            </a>
                                        </li><!--mvp-blog-story-wrap-->
                                    @endforeach
                                </ul>

                                {{$blogs->links('pagination::bootstrap-5')}}

                            </div><!--mvp-main-blog-body-->
                        </div><!--mvp-mvp-main-blog-in-->
                        <div id="mvp-side-wrap" class="left relative theiaStickySidebar">
                        </div><!--mvp-side-wrap-->
                    </div><!--mvp-mvp-main-blog-out-->
                </div><!--mvp-main-blog-cont-->
            </div><!--mvp-main-box-->
        </div><!--mvp-main-blog-wrap-->
    </div>
@endsection

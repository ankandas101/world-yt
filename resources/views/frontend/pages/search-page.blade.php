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
    {{ $search_text ?: 'Search Blog' }}
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
    <meta property="og:title" content="{{ $search_text ?: 'Search Blog' }}" />
    <meta property="og:description" content="{{ $og_description }}" />
    <meta property="og:image" content="{{ $og_img }}" />
    <meta property="og:image:alt" content="{{ $og_site_name }}">
    <meta property="og:locale" content="en_US" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $search_text ?: 'Search Blog' }}" />
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
                    "name": "{{ $search_text ?: 'Search Blog' }}",
                    "description": "{{'Latest posts in ' . $search_text ?: 'Search Blog' }}",
                    "url": "{{ url()->current() }}"
                },
                {
                    "@type": "ItemList",
                    "itemListElement": [
                        @foreach($results as $index => $blog)
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
                            "name": "{{ $search_text ?: 'Search Blog' }}",
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
                    <header id="mvp-post-head" class="left relative">
                        <h1 class="mvp-post-title left entry-title" itemprop="headline">Search results for "{{ $search_text }}"</h1>
                    </header>
                    <div class="mvp-main-blog-out left relative">
                        <div class="mvp-main-blog-in">
                            <div class="mvp-main-blog-body left relative">
                                <ul class="mvp-blog-story-list left relative infinite-content">
                                    @foreach ($results as $blog)
                                        <li class="mvp-blog-story-wrap left relative infinite-post">
                                            <a href="{{route("blog_detail",$blog->slug)}}"
                                                rel="bookmark">
                                                <div class="mvp-blog-story-out relative">
                                                    <div class="mvp-blog-story-img left relative">
                                                        <img width="900" height="471"
                                                            src="{{ photo($blog->image,'blog') }}"
                                                            class="mvp-big-img wp-post-image" alt="{{ $blog->title }}" decoding="async"
                                                            loading="lazy"
                                                            sizes="auto, (max-width: 900px) 100vw, 900px">
                                                        <img width="400"
                                                            height="240"
                                                            src="{{ photo($blog->image,'blog') }}"
                                                            class="mvp-reg-img lazy wp-post-image" alt="{{ $blog->title }}"
                                                            decoding="async" loading="lazy"
                                                            sizes="auto, (max-width: 400px) 100vw, 400px">
                                                        <img width="80"
                                                            height="80"
                                                            src="{{ photo($blog->image,'blog') }}"
                                                            class="mvp-mob-img lazy wp-post-image" alt="{{ $blog->title }}"
                                                            decoding="async" loading="lazy"
                                                            sizes="auto, (max-width: 80px) 100vw, 80px">
                                                    </div><!--mvp-blog-story-img-->
                                                    <div class="mvp-blog-story-in">
                                                        <div class="mvp-blog-story-text left relative">
                                                            <div class="mvp-cat-date-wrap left relative">
                                                                <span class="mvp-cd-cat left relative">{{ $blog->category?->name}}</span><span
                                                                    class="mvp-cd-date left relative">{{ $blog->created_at?->diffForHumans() }}</span>
                                                            </div><!--mvp-cat-date-wrap-->
                                                            <h2>
                                                                {{ $blog->title }}
                                                            </h2>
                                                            <p>
                                                                {{ str(strip_tags($blog->content))->words(20) }}
                                                            </p>
                                                        </div><!--mvp-blog-story-text-->
                                                    </div><!--mvp-blog-story-in-->
                                                </div><!--mvp-blog-story-out-->
                                            </a>
                                        </li><!--mvp-blog-story-wrap-->
                                    @endforeach
                                    {{-- <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/understanding-0333-number-what-they-mean-and-how-they-work/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="900" height="471"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/08/4-37.png"
                                                        class="mvp-big-img wp-post-image" alt="0333 Number" decoding="async"
                                                        loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/08/4-37.png 900w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/4-37-300x157.png 300w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/4-37-768x402.png 768w"
                                                        sizes="auto, (max-width: 900px) 100vw, 900px"> <img width="400"
                                                        height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/08/4-37-400x240.png"
                                                        class="mvp-reg-img lazy wp-post-image" alt="0333 Number"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/08/4-37-400x240.png 400w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/4-37-590x354.png 590w"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/08/4-37-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image" alt="0333 Number"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/08/4-37-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/4-37-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">TECH</span><span
                                                                class="mvp-cd-date left relative">1 year ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>Understanding 0333 Number-What They Mean and How They Work</h2>
                                                        <p>In today’s diverse telephone landscape, 0333 numbers are
                                                            increasingly common. This guide explains what 0333 numbers are,
                                                            how they function, and their benefits for businesses and...</p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap-->
                                    <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/boost-your-immunity-with-apple-cider-vinegar/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="602" height="395"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/08/Untitled-1-1.png"
                                                        class="mvp-big-img wp-post-image" alt="" decoding="async"
                                                        loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/08/Untitled-1-1.png 602w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/Untitled-1-1-300x197.png 300w"
                                                        sizes="auto, (max-width: 602px) 100vw, 602px"> <img width="400"
                                                        height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/08/Untitled-1-1-400x240.png"
                                                        class="mvp-reg-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/08/Untitled-1-1-400x240.png 400w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/Untitled-1-1-590x354.png 590w"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/08/Untitled-1-1-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/08/Untitled-1-1-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/Untitled-1-1-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">HEALTH</span><span
                                                                class="mvp-cd-date left relative">1 year ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>Boost Your Immunity with Apple Cider Vinegar</h2>
                                                        <p>Apple cider vinegar (ACV) has been a popular natural remedy for
                                                            centuries, known for its numerous health benefits. Among its
                                                            many uses, boosting immunity is one...</p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap-->
                                    <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/1v1-lol-unblocked-your-complete-guide-to-winning/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="1000" height="600"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/08/1v1.lol-Unblocked-1000x600.png"
                                                        class="mvp-big-img wp-post-image" alt="1v1.lol Unblocked"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/08/1v1.lol-Unblocked-1000x600.png 1000w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/1v1.lol-Unblocked-590x354.png 590w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/1v1.lol-Unblocked-400x240.png 400w"
                                                        sizes="auto, (max-width: 1000px) 100vw, 1000px"> <img
                                                        width="400" height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/08/1v1.lol-Unblocked-400x240.png"
                                                        class="mvp-reg-img lazy wp-post-image" alt="1v1.lol Unblocked"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/08/1v1.lol-Unblocked-400x240.png 400w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/1v1.lol-Unblocked-1000x600.png 1000w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/1v1.lol-Unblocked-590x354.png 590w"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/08/1v1.lol-Unblocked-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image" alt="1v1.lol Unblocked"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/08/1v1.lol-Unblocked-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/08/1v1.lol-Unblocked-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">TECH</span><span
                                                                class="mvp-cd-date left relative">1 year ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>1v1.lol Unblocked-Your Complete Guide to WinningYour Complete
                                                            Guide to Winning Every Battle</h2>
                                                        <p>Introduction In the dynamic world of online gaming, 1v1.lol
                                                            Unblocked has emerged as a standout title, captivating players
                                                            with its unique blend of building and shooting...</p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap-->
                                    <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/the-role-of-fire-extinguishers-essential-gear-for-every-flat/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="1000" height="600"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/10/The-Role-of-Fire-Extinguishers-Essential-Gear-for-Every-Flat-1000x600.png"
                                                        class="mvp-big-img wp-post-image"
                                                        alt="The Role of Fire Extinguishers Essential Gear for Every Flat"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/10/The-Role-of-Fire-Extinguishers-Essential-Gear-for-Every-Flat-1000x600.png 1000w, https://wordlenyt.co.uk/wp-content/uploads/2024/10/The-Role-of-Fire-Extinguishers-Essential-Gear-for-Every-Flat-590x354.png 590w, https://wordlenyt.co.uk/wp-content/uploads/2024/10/The-Role-of-Fire-Extinguishers-Essential-Gear-for-Every-Flat-400x240.png 400w"
                                                        sizes="auto, (max-width: 1000px) 100vw, 1000px"> <img
                                                        width="400" height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/10/The-Role-of-Fire-Extinguishers-Essential-Gear-for-Every-Flat-400x240.png"
                                                        class="mvp-reg-img lazy wp-post-image"
                                                        alt="The Role of Fire Extinguishers Essential Gear for Every Flat"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/10/The-Role-of-Fire-Extinguishers-Essential-Gear-for-Every-Flat-400x240.png 400w, https://wordlenyt.co.uk/wp-content/uploads/2024/10/The-Role-of-Fire-Extinguishers-Essential-Gear-for-Every-Flat-1000x600.png 1000w, https://wordlenyt.co.uk/wp-content/uploads/2024/10/The-Role-of-Fire-Extinguishers-Essential-Gear-for-Every-Flat-590x354.png 590w"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/10/The-Role-of-Fire-Extinguishers-Essential-Gear-for-Every-Flat-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image"
                                                        alt="The Role of Fire Extinguishers Essential Gear for Every Flat"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/10/The-Role-of-Fire-Extinguishers-Essential-Gear-for-Every-Flat-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/10/The-Role-of-Fire-Extinguishers-Essential-Gear-for-Every-Flat-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">BLOG</span><span
                                                                class="mvp-cd-date left relative">11 months ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>The Role of Fire Extinguishers: Essential Gear for Every Flat
                                                        </h2>
                                                        <p>Fire safety is a critical concern for anyone living in a flat.
                                                            While we hope to never face a fire emergency, having the right
                                                            tools on...</p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap-->
                                    <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/the-connection-between-diet-and-hormonal-imbalances-in-women/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="626" height="417"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXckPUGlmbesoqaYAP54MXGVdbSh.png"
                                                        class="mvp-big-img wp-post-image" alt="" decoding="async"
                                                        loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXckPUGlmbesoqaYAP54MXGVdbSh.png 626w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXckPUGlmbesoqaYAP54MXGVdbSh-300x200.png 300w"
                                                        sizes="auto, (max-width: 626px) 100vw, 626px"> <img width="400"
                                                        height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXckPUGlmbesoqaYAP54MXGVdbSh-400x240.png"
                                                        class="mvp-reg-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXckPUGlmbesoqaYAP54MXGVdbSh-400x240.png 400w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXckPUGlmbesoqaYAP54MXGVdbSh-590x354.png 590w"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXckPUGlmbesoqaYAP54MXGVdbSh-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXckPUGlmbesoqaYAP54MXGVdbSh-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXckPUGlmbesoqaYAP54MXGVdbSh-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">BLOG</span><span
                                                                class="mvp-cd-date left relative">11 months ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>The Connection between Diet and Hormonal Imbalances in Women
                                                        </h2>
                                                        <p>Source: Freepik.com It’s an undeniable fact that good nutrition
                                                            is essential for a healthy body. Consuming the right amount can
                                                            improve the production and activity of...</p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap-->
                                    <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/how-abdominoplasty-can-transform-your-body/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="1000" height="600"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/tummy-tuck-102-view-1-detail-1000x600.png"
                                                        class="mvp-big-img wp-post-image" alt="" decoding="async"
                                                        loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/tummy-tuck-102-view-1-detail-1000x600.png 1000w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/tummy-tuck-102-view-1-detail-590x354.png 590w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/tummy-tuck-102-view-1-detail-400x240.png 400w"
                                                        sizes="auto, (max-width: 1000px) 100vw, 1000px"> <img
                                                        width="400" height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/tummy-tuck-102-view-1-detail-400x240.png"
                                                        class="mvp-reg-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/tummy-tuck-102-view-1-detail-400x240.png 400w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/tummy-tuck-102-view-1-detail-1000x600.png 1000w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/tummy-tuck-102-view-1-detail-590x354.png 590w"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/tummy-tuck-102-view-1-detail-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/tummy-tuck-102-view-1-detail-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/tummy-tuck-102-view-1-detail-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">BLOG</span><span
                                                                class="mvp-cd-date left relative">11 months ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>How Abdominoplasty Can Transform Your Body</h2>
                                                        <p>Abdominoplasty, often referred to as a “tummy tuck,” is a
                                                            surgical procedure that can significantly improve the appearance
                                                            of your abdomen. It’s a popular choice for...</p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap-->
                                    <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/kirill-yurovskiy-decoding-the-wine-labels/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-text left relative">
                                                <div class="mvp-cat-date-wrap left relative">
                                                    <span class="mvp-cd-cat left relative">BLOG</span><span
                                                        class="mvp-cd-date left relative">11 months ago</span>
                                                </div><!--mvp-cat-date-wrap-->
                                                <h2>Kirill Yurovskiy: Decoding the Wine Labels</h2>
                                                <p>Ah, the wine aisle, maze of bottles, each and everyone promising an
                                                    adventure waiting to be uncorked. But let’s face it, staring at all
                                                    those labels...</p>
                                            </div><!--mvp-blog-story-text-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap-->
                                    <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/the-ultimate-guide-to-a-smooth-and-flavorful-vaping-experience/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="650" height="600"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXdywjMcONyp-yBI_hS9mM79edWs-650x600.png"
                                                        class="mvp-big-img wp-post-image" alt="" decoding="async"
                                                        loading="lazy"> <img width="400" height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXdywjMcONyp-yBI_hS9mM79edWs-400x240.png"
                                                        class="mvp-reg-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXdywjMcONyp-yBI_hS9mM79edWs-400x240.png 400w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXdywjMcONyp-yBI_hS9mM79edWs-590x354.png 590w"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXdywjMcONyp-yBI_hS9mM79edWs-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXdywjMcONyp-yBI_hS9mM79edWs-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXdywjMcONyp-yBI_hS9mM79edWs-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">BLOG</span><span
                                                                class="mvp-cd-date left relative">12 months ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>The Ultimate Guide to a Smooth and Flavorful Vaping Experience
                                                        </h2>
                                                        <p>In this ultimate guide to Dabwoods, we’ll discover what sets it
                                                            apart while exploring why so many users find themselves drawn to
                                                            Dabwoods as they search...</p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap-->
                                    <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/easiest-methods-to-spell-check-pdf-files-in-2024/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="1000" height="600"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXcH_-5u4ZczPcm0z5PKKBROrQwp-1000x600.png"
                                                        class="mvp-big-img wp-post-image"
                                                        alt="Easiest Methods to Spell Check PDF Files in 2024"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXcH_-5u4ZczPcm0z5PKKBROrQwp-1000x600.png 1000w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXcH_-5u4ZczPcm0z5PKKBROrQwp-590x354.png 590w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXcH_-5u4ZczPcm0z5PKKBROrQwp-400x240.png 400w"
                                                        sizes="auto, (max-width: 1000px) 100vw, 1000px"> <img
                                                        width="400" height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXcH_-5u4ZczPcm0z5PKKBROrQwp-400x240.png"
                                                        class="mvp-reg-img lazy wp-post-image"
                                                        alt="Easiest Methods to Spell Check PDF Files in 2024"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXcH_-5u4ZczPcm0z5PKKBROrQwp-400x240.png 400w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXcH_-5u4ZczPcm0z5PKKBROrQwp-1000x600.png 1000w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXcH_-5u4ZczPcm0z5PKKBROrQwp-590x354.png 590w"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXcH_-5u4ZczPcm0z5PKKBROrQwp-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image"
                                                        alt="Easiest Methods to Spell Check PDF Files in 2024"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXcH_-5u4ZczPcm0z5PKKBROrQwp-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AD_4nXcH_-5u4ZczPcm0z5PKKBROrQwp-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">BLOG</span><span
                                                                class="mvp-cd-date left relative">12 months ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>Easiest Methods to Spell Check PDF Files in 2024</h2>
                                                        <p>With PDFs used universally for distributing business documents,
                                                            ebooks, forms and more, errors like typos and misspellings get
                                                            magnified when content is published to final PDF...</p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap--> --}}
                                </ul>
                                {{$results->links('pagination::bootstrap-5')}}
                            </div><!--mvp-main-blog-body-->
                        </div><!--mvp-mvp-main-blog-in-->
                        <div id="mvp-side-wrap" class="left relative theiaStickySidebar">
                            <section id="block-104" class="mvp-side-widget widget_block widget_media_gallery">
                                <figure
                                    class="wp-block-gallery has-nested-images columns-default is-cropped wp-block-gallery-1 is-layout-flex wp-block-gallery-is-layout-flex">
                                </figure>
                            </section>
                        </div><!--mvp-side-wrap-->
                    </div><!--mvp-mvp-main-blog-out-->
                </div><!--mvp-main-blog-cont-->
            </div><!--mvp-main-box-->
        </div><!--mvp-main-blog-wrap-->
    </div>
@endsection

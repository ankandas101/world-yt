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
    {{ $author?->name ?: 'Unknown' }}
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
    <meta property="og:title" content="{{ $author?->name ?: 'Category' }}" />
    <meta property="og:description" content="{{ $og_description }}" />
    <meta property="og:image" content="{{ $og_img }}" />
    <meta property="og:image:alt" content="{{ $og_site_name }}">
    <meta property="og:locale" content="en_US" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $author->name }}" />
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
                    "name": "{{ $author->name }}",
                    "description": "{{ $author->description ?? 'Latest posts in ' . $author->name }}",
                    "url": "{{ url()->current() }}"
                },
                {
                    "@type": "ItemList",
                    "itemListElement": [
                        @foreach($author?->blogs as $index => $blog)
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
                            "name": "{{ $author->name }}",
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
                    <div id="mvp-author-page-top" class="left relative">
                        <div class="mvp-author-top-out right relative">
                            <div id="mvp-author-top-left" class="left relative">
                                <img alt="{{ $author->name }}"
                                    src="{{ photo($author->photo,'user')}}"
                                    class="avatar avatar-200 photo" height="200" width="200" decoding="async">
                            </div><!--mvp-author-top-left-->
                            <div class="mvp-author-top-in">
                                <div id="mvp-author-top-right" class="left relative">
                                    <h1 class="mvp-author-top-head left">Nelson Bill</h1>
                                    <span class="mvp-author-page-desc left relative"></span>
                                    <ul class="mvp-author-page-list left relative">
                                    </ul>
                                </div><!--mvp-author-top-right-->
                            </div><!--mvp-author-top-in-->
                        </div><!--mvp-author-top-out-->
                    </div><!--mvp-author-page-top-->
                    <div class="mvp-main-blog-out left relative">
                        <div class="mvp-main-blog-in">
                            <div class="mvp-main-blog-body left relative">
                                <div class="mvp-widget-home-head">
                                    <h4 class="mvp-widget-home-title"><span class="mvp-widget-home-title">Stories By {{ $author->name }}</span></h4>
                                </div><!--mvp-widget-home-head-->
                                <ul class="mvp-blog-story-list left relative infinite-content">
                                    @foreach ($blogs as $blog)
                                        <li class="mvp-blog-story-wrap left relative infinite-post">
                                            <a href="{{route('blog_detail',$blog->slug)}}"
                                                rel="bookmark">
                                                <div class="mvp-blog-story-out relative">
                                                    <div class="mvp-blog-story-img left relative">
                                                        <img width="400" height="240"
                                                            src="{{ photo($blog->image,'blog') }}"
                                                            class="mvp-reg-img lazy wp-post-image"
                                                            alt="{{ $blog->title }}"
                                                            decoding="async" loading="lazy"
                                                            sizes="auto, (max-width: 400px) 100vw, 400px">
                                                        <img width="80"
                                                            height="80"
                                                            src="{{ photo($blog->image,'blog') }}"
                                                            class="mvp-mob-img lazy wp-post-image"
                                                            alt="{{ $blog->title }}"
                                                            decoding="async" loading="lazy"
                                                            sizes="auto, (max-width: 80px) 100vw, 80px">
                                                    </div><!--mvp-blog-story-img-->
                                                    <div class="mvp-blog-story-in">
                                                        <div class="mvp-blog-story-text left relative">
                                                            <div class="mvp-cat-date-wrap left relative">
                                                                <span class="mvp-cd-cat left relative">{{ $blog->category?->name }}</span><span
                                                                    class="mvp-cd-date left relative">{{ $blog->created_at?->diffForHumans() }}</span>
                                                            </div><!--mvp-cat-date-wrap-->
                                                            <h2>
                                                                {{ $blog->title }}
                                                            </h2>
                                                            <p>
                                                                {{ str(strip_tags($blog->content))->words(25) }}
                                                            </p>
                                                        </div><!--mvp-blog-story-text-->
                                                    </div><!--mvp-blog-story-in-->
                                                </div><!--mvp-blog-story-out-->
                                            </a>
                                        </li><!--mvp-blog-story-wrap-->
                                    @endforeach
                                    {{-- <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/the-connection-between-diet-and-hormonal-imbalances-in-women/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="400" height="240"
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
                                                    <img width="400" height="240"
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
                                                    <img width="400" height="240"
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
                                                    <img width="400" height="240"
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
                                    </li><!--mvp-blog-story-wrap-->
                                    <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/nurturing-strong-lgbtq-relationships-tips/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="400" height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AdobeStock_374858067-1024x683-1-400x240.png"
                                                        class="mvp-reg-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AdobeStock_374858067-1024x683-1-400x240.png 400w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AdobeStock_374858067-1024x683-1-1000x600.png 1000w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AdobeStock_374858067-1024x683-1-590x354.png 590w"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AdobeStock_374858067-1024x683-1-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/AdobeStock_374858067-1024x683-1-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/AdobeStock_374858067-1024x683-1-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">BLOG</span><span
                                                                class="mvp-cd-date left relative">12 months ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>Nurturing Strong LGBTQ+ Relationships Tips</h2>
                                                        <p>Very strong associations with family, mates, and loved ones are
                                                            made on a solid foundation of connection , respect, honesty, and
                                                            kindness. But this foundation doesn’t...</p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap-->
                                    <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/how-to-get-the-most-out-of-your-car-repair-budget-in-gladesville/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="400" height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/3-1-400x240.png"
                                                        class="mvp-reg-img lazy wp-post-image"
                                                        alt="How to Get the Most Out of Your Car Repair Budget in Gladesville"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/3-1-400x240.png 400w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/3-1-1000x600.png 1000w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/3-1-590x354.png 590w"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/3-1-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image"
                                                        alt="How to Get the Most Out of Your Car Repair Budget in Gladesville"
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/3-1-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/3-1-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">BLOG</span><span
                                                                class="mvp-cd-date left relative">12 months ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>How to Get the Most Out of Your Car Repair Budget in Gladesville
                                                        </h2>
                                                        <p>Car repairs are an inevitable part of vehicle ownership, but they
                                                            don’t have to break the bank. With a little planning and some
                                                            savvy decision-making, you...</p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap-->
                                    <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/how-to-ensure-your-food-delivery-app-stands-out-in-a-competitive-market/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="400" height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/s-400x240.png"
                                                        class="mvp-reg-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/s-400x240.png 400w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/s-1000x600.png 1000w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/s-590x354.png 590w"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/s-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/s-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/s-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">BLOG</span><span
                                                                class="mvp-cd-date left relative">12 months ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>How to Ensure Your Food Delivery App Stands Out in a Competitive
                                                            Market</h2>
                                                        <p>The food delivery industry is thriving, and its growth continues
                                                            to accelerate, especially after the global pandemic. With
                                                            customers increasingly opting for the convenience of having...
                                                        </p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap--> --}}
                                    {{-- <li class="mvp-blog-story-wrap left relative infinite-post">
                                        <a href="https://wordlenyt.co.uk/alexander-ostrovskiy-the-art-of-action-creation/"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="330" height="240"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/image-330x240.png"
                                                        class="mvp-reg-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"> <img width="80"
                                                        height="80"
                                                        src="https://wordlenyt.co.uk/wp-content/uploads/2024/09/image-80x80.png"
                                                        class="mvp-mob-img lazy wp-post-image" alt=""
                                                        decoding="async" loading="lazy"
                                                        srcset="https://wordlenyt.co.uk/wp-content/uploads/2024/09/image-80x80.png 80w, https://wordlenyt.co.uk/wp-content/uploads/2024/09/image-150x150.png 150w"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px">
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">BLOG</span><span
                                                                class="mvp-cd-date left relative">1 year ago</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>Alexander Ostrovskiy: The Art of Action Creation</h2>
                                                        <p>Imagine this: You’re hiding behind a disintegrating wall, your
                                                            virtual heart dashing as shots whistle above. Out of nowhere,
                                                            your simulated intelligence friend yells an admonition—the...
                                                        </p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap--> --}}
                                </ul>
                                <div class="mvp-inf-more-wrap left relative">
                                    {{ $blogs->links('pagination::bootstrap-5')}}
                                </div><!--mvp-inf-more-wrap-->
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

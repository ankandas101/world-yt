@php
    $db_data_cached = $cdd;
    $og_url = url()->current();
    $site_meta_title = $db_data_cached->site_seo?->meta_title;
    $site_img = asset(photo($db_data_cached->site_info?->site_logo, 'logo'));

    $postUrl = $blog->robust_seo?->conical_url ?: url()->current();
    $postTitle = $blog->robust_seo?->meta_title ?: $blog->title;
    $postDescription = $blog->robust_seo?->meta_description ?: Str::limit(strip_tags($blog->content), 150);
    $postImg = asset(photo($blog->image, 'blog'));
    [$headings, $contentWithIds] = generateTableOfContents($blog->content);
    $tocHtml = buildTocHtml($headings);
@endphp

@extends('frontend.layout.app')

@push('title')
    {{ $blog->title }}
@endpush

@push('meta_seo')
    {{-- Global Seo Content --}}

    <meta name="description" content="{{ $postDescription }}" />
    <link rel="canonical" href="{{ $postUrl }}" />
    {{-- Blog Open Graph --}}
    <meta property="og:url" content="{{ $postUrl }}" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="{{ $postTitle }}" />
    <meta property="og:title" content="{{ $postTitle }}" />
    <meta property="og:description" content="{{ $postDescription }}" />
    <meta property="og:image" content="{{ $postImg }}" />
    <meta property="og:image:alt" content="{{ $blog->image_alt_text }}">
    <meta property="og:locale" content="en_US" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $postTitle }}" />
    <meta name="twitter:description" content="{{ $postDescription }}" />
    <meta name="twitter:image" content="{{ $postImg }}" />
@endpush

@push('seo_schema')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "BlogPosting",
                "mainEntityOfPage": {
                    "@type": "WebPage",
                    "@id": "{{ url()->current() }}"
                },
                "headline": "{{ $postTitle }}",
                "description": "{{ $postDescription }}",
                "image": {
                    "@type": "ImageObject",
                    "url": "{{ $postImg }}"
                },
                "author": {
                    "@type": "Person",
                    "name": "{{ $blog->author->name ?? 'Admin' }}"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "{{ $site_meta_title }}",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ $site_img }}"
                    }
                },
                "datePublished": "{{ $blog->created_at->toW3cString() }}",
                "dateModified": "{{ $blog->updated_at->toW3cString() }}"
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
                        "name": "{{ $blog->category->name ?? 'Blog' }}",
                        "item": "{{ route('cat_subcat_wise_blog' , $blog->category->slug) }}"
                    },
                    {
                        "@type": "ListItem",
                        "position": 3,
                        "name": "{{ $blog->title }}",
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
        <article id="mvp-article-wrap" itemscope="" itemtype="http://schema.org/NewsArticle">
            <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage"
                itemid="{{ route('blog_detail', $blog->slug) }}">
            <div id="mvp-article-cont" class="left relative">
                <div class="mvp-main-box">
                    <div id="mvp-post-main" class="left relative">
                        <header id="mvp-post-head" class="left relative">
                            {{-- <h2 class="mvp-post-cat left relative">
                                <a class="mvp-post-cat-link"
                                    href="{{ route('cat_subcat_wise_blog', $blog?->category?->slug) }}">
                                    <span class="mvp-post-cat left">{{ $blog?->category?->name }}</span>
                                </a>
                            </h2> --}}
                            <h1 class="mvp-post-title left entry-title" itemprop="headline">
                                {{ $blog->title }}
                            </h1>
                            <div class="mvp-author-info-wrap left relative">
                                <div class="mvp-author-info-thumb left relative">
                                    <img alt="{{ $blog->author?->name }}" src="{{ photo($blog->author?->photo, 'user') }}"
                                        class="avatar avatar-46 photo" height="46" width="46" decoding="async">
                                </div><!--mvp-author-info-thumb-->
                                <div class="mvp-author-info-text left relative text-black">
                                    <div class="mvp-author-info-date left relative">
                                        <p>Published</p> <span
                                            class="mvp-post-date">{{ $blog->created_at?->diffForHumans() }}</span>
                                        <p>on</p> <span class="mvp-post-date updated"><time class="post-date updated"
                                                itemprop="datePublished"
                                                datetime="{{ $blog->created_at?->format('d-m-Y') }}">{{ $blog->created_at?->format('F j, Y') }}</time></span>

                                    </div><!--mvp-author-info-date-->
                                    <div class="mvp-author-info-name left relative" itemprop="author">
                                        <p>By</p> <span class="author-name vcard fn author">
                                            <a href="{{ route('author', $blog->author?->username ?: 'invalid') }}"
                                                title="{{ $blog->author?->name }}"
                                                rel="author">{{ $blog->author?->name }}</a>
                                        </span>
                                    </div><!--mvp-author-info-name-->
                                </div><!--mvp-author-info-text-->
                            </div><!--mvp-author-info-wrap-->
                        </header>
                        <div class="mvp-post-main-out left relative">
                            <div class="mvp-post-main-in">
                                <div id="mvp-post-content" class="left relative">
                                    <div id="mvp-post-feat-img" class="left relative mvp-post-feat-img-wide2">
                                        <img width="1400" height="934" src="{{ photo($blog->image, 'blog') }}"
                                            class="attachment- size- wp-post-image" alt="{{ $blog->title }}"
                                            decoding="async" fetchpriority="high">
                                    </div><!--mvp-post-feat-img-->
                                    <div id="mvp-content-wrap" class="left relative">
                                        <div class="mvp-post-soc-out right relative">
                                            <div class="mvp-post-soc-wrap left relative" style="width: 100% !important; margin-bottom: 30px;">
                                                <ul class="mvp-post-soc-list left relative" aria-label="Social Media Share" style="display: flex; min-width: 300px;">
                                                   <li>
                                                        <a href="#" aria-label="Share on Facebook"
                                                            onclick="window.open('http://www.facebook.com/sharer.php?u={{ url()->current() }}/&amp;t={{ $blog->title }}', 'facebookShare', 'width=626,height=436'); return false;"
                                                            title="Share on Facebook">
                                                            <li class="mvp-post-soc-fb">
                                                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                                            </li>
                                                        </a>
                                                   </li>
                                                    <li>
                                                        <a href="#" aria-label="Tweet This Post"
                                                            onclick="window.open('http://twitter.com/intent/tweet?text={{ $blog->title }} -&amp;url={{ url()->current() }}', 'twitterShare', 'width=626,height=436'); return false;"
                                                            title="Tweet This Post">
                                                            <li class="mvp-post-soc-twit">
                                                                <i class="fab fa-twitter" aria-hidden="true"></i>
                                                            </li>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" aria-label="Pin This Post"
                                                            onclick="window.open('http://pinterest.com/pin/create/button/?url={{ url()->current() }}/&amp;media={{ photo($blog->image, 'blog') }}&amp;description={{ str(strip_tags($blog->content))->words(25) }}', 'pinterestShare', 'width=750,height=350'); return false;"
                                                            title="Pin This Post">
                                                            <li class="mvp-post-soc-pin">
                                                                <i class="fab fa-pinterest-p" aria-hidden="true"></i>
                                                            </li>
                                                        </a>
                                                    </li>
                                                   <li>
                                                    <a aria-label="Email This Post"
                                                        href="mailto:?subject={{ $blog->title }}&amp;BODY={{ str(strip_tags($blog->content))->words(25) }}: {{ url()->current() }}">
                                                        <li class="mvp-post-soc-email">
                                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                                        </li>
                                                    </a>
                                                   </li>
                                                </ul>
                                            </div><!--mvp-post-soc-wrap-->
                                            <div id="mvp-soc-mob-wrap" class="">
                                                <div class="mvp-soc-mob-out left relative">
                                                    <div class="mvp-soc-mob-in">
                                                        <div class="mvp-soc-mob-left left relative">
                                                            <ul class="mvp-soc-mob-list left relative">
                                                               <li>
                                                                    <a href="#" aria-label="Share on Facebook"
                                                                        onclick="window.open('http://www.facebook.com/sharer.php?u={{ url()->current() }}/&amp;t={{ $blog->title }}', 'facebookShare', 'width=626,height=436'); return false;"
                                                                        title="Share on Facebook">
                                                                        <li class="mvp-soc-mob-fb">
                                                                            <i class="fab fa-facebook-f"
                                                                                aria-hidden="true"></i><span
                                                                                class="mvp-soc-mob-fb">Share</span>
                                                                        </li>
                                                                    </a>
                                                               </li>
                                                               <li>
                                                                    <a href="#" aria-label="Tweet This Post"
                                                                        onclick="window.open('http://twitter.com/share?text={{ $blog->title }} -&amp;url={{ url()->current() }}/', 'twitterShare', 'width=626,height=436'); return false;"
                                                                        title="Tweet This Post">
                                                                        <li class="mvp-soc-mob-twit"
                                                                            style="color: black !important;">
                                                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                                                            <span class="mvp-soc-mob-fb"
                                                                                style="color: black !important;">Tweet</span>
                                                                        </li>
                                                                    </a>
                                                               </li>
                                                               <li>
                                                                    <a href="#" aria-label="Pin This Post"
                                                                        onclick="window.open('http://pinterest.com/pin/create/button/?url={{ url()->current() }}/&amp;media={{ photo($blog->image, 'blog') }}&amp;description={{ str(strip_tags($blog->content))->words(25) }}', 'pinterestShare', 'width=750,height=350'); return false;"
                                                                        title="Pin This Post">
                                                                        <li class="mvp-soc-mob-pin">
                                                                            <i class="fab fa-pinterest-p"
                                                                                aria-hidden="true"></i>
                                                                        </li>
                                                                    </a>
                                                               </li>
                                                                <li>
                                                                    <a aria-label="WhatsApp This Post" href="whatsapp://send?text={{ $blog->title }}/"></a>
                                                                </li>
                                                              <li>
                                                                    <div class="whatsapp-share">
                                                                        <a aria-label="WhatsApp This Post"
                                                                        href="whatsapp://send?text={{ $blog->title }} {{ url()->current() }}/"><span
                                                                            class="whatsapp-but1">
                                                                            <span class="mvp-soc-mob-what">
                                                                                <i class="fab fa-whatsapp"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                        </span></a>
                                                                        <a aria-label="Email This Post"
                                                                            href="mailto:?subject={{ $blog->title }}&amp;BODY={{ str(strip_tags($blog->content))->words(25) }}: {{ url()->current() }}/">
                                                                            <span class="mvp-soc-mob-email">
                                                                                <i class="fa fa-envelope"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                              </li>
                                                            </ul>
                                                        </div><!--mvp-soc-mob-left-->
                                                    </div><!--mvp-soc-mob-in-->
                                                    <div class="mvp-soc-mob-right left relative">
                                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                    </div><!--mvp-soc-mob-right-->
                                                </div><!--mvp-soc-mob-out-->
                                            </div><!--mvp-soc-mob-wrap-->
                                            <div class="mvp-post-soc-in">
                                                <div id="mvp-content-body" class="left relative">
                                                    <div id="mvp-content-body-top" class="left relative">
                                                        <div id="mvp-content-main" class="left relative">
                                                            {!! $blog->content !!}
                                                        </div><!--mvp-content-main-->
                                                        @php
                                                            $related_blog = $related_blogs->splice(-1, 1)->first();
                                                            $up_next = $related_blogs->splice(-1, 1)->first();
                                                            $previous = $related_blogs->splice(-1, 1)->first();
                                                        @endphp
                                                        <div id="mvp-content-bot" class="left">
                                                            @if ($related_blog)
                                                                <div class="mvp-post-tags">
                                                                    <span class="mvp-post-tags-header">Related
                                                                        Topics:</span><span itemprop="keywords">

                                                                        <a style="color:#01017ac2 !important;"
                                                                            href="{{ route('blog_detail', $related_blog->slug) }}"
                                                                            rel="tag">{{ $related_blog->title }}</a></span>
                                                                </div><!--mvp-post-tags-->
                                                            @endif
                                                            <div class="posts-nav-link">
                                                            </div><!--posts-nav-link-->
                                                            <div id="mvp-prev-next-wrap" class="left relative">
                                                                <div class="mvp-next-post-wrap right relative">
                                                                    @if ($up_next)
                                                                        <a href="{{ route('blog_detail', $up_next->slug) }}"
                                                                            rel="bookmark" aria-label="Up Next">
                                                                            <div class="mvp-prev-next-cont left relative">
                                                                                <div
                                                                                    class="mvp-next-cont-out left relative">
                                                                                    <div class="mvp-next-cont-in">
                                                                                        <div
                                                                                            class="mvp-prev-next-text left relative">
                                                                                            <span
                                                                                                class="mvp-prev-next-label left relative">Up
                                                                                                Next</span>
                                                                                            <p>
                                                                                                {{ $up_next->title }}
                                                                                            </p>
                                                                                        </div><!--mvp-prev-next-text-->
                                                                                    </div><!--mvp-next-cont-in-->
                                                                                    <span
                                                                                        class="mvp-next-arr fa fa-chevron-right right"></span>
                                                                                </div><!--mvp-prev-next-out-->
                                                                            </div><!--mvp-prev-next-cont-->
                                                                        </a>
                                                                    @endif
                                                                </div><!--mvp-next-post-wrap-->
                                                                <div class="mvp-prev-post-wrap left relative">
                                                                    @if ($previous)
                                                                        <a href="{{ route('blog_detail', $previous->slug) }}"
                                                                            rel="bookmark" aria-label="Don't Miss">
                                                                            <div class="mvp-prev-next-cont left relative">
                                                                                <div
                                                                                    class="mvp-prev-cont-out right relative">
                                                                                    <span
                                                                                        class="mvp-prev-arr fa fa-chevron-left left"></span>
                                                                                    <div class="mvp-prev-cont-in">
                                                                                        <div
                                                                                            class="mvp-prev-next-text left relative">
                                                                                            <span
                                                                                                class="mvp-prev-next-label left relative">Don't
                                                                                                Miss</span>
                                                                                            <p>
                                                                                                {{ $previous->title }}
                                                                                            </p>
                                                                                        </div><!--mvp-prev-next-text-->
                                                                                    </div><!--mvp-prev-cont-in-->
                                                                                </div><!--mvp-prev-cont-out-->
                                                                            </div><!--mvp-prev-next-cont-->
                                                                        </a>
                                                                    @endif
                                                                </div><!--mvp-prev-post-wrap-->
                                                            </div><!--mvp-prev-next-wrap-->
                                                            <div class="mvp-org-wrap" itemprop="publisher" itemscope=""
                                                                itemtype="https://schema.org/Organization">
                                                                <div class="mvp-org-logo" itemprop="logo" itemscope=""
                                                                    itemtype="https://schema.org/ImageObject">
                                                                    <img alt="{{ $blog->title }}" loading="lazy"
                                                                        src="{{ photo($blog->image, 'blog') }}">
                                                                    <meta itemprop="url"
                                                                        content="{{ photo($blog->image, 'blog') }}">
                                                                </div><!--mvp-org-logo-->
                                                                <meta itemprop="name" content="Wordle NYT">
                                                            </div><!--mvp-org-wrap-->
                                                        </div><!--mvp-content-bot-->
                                                    </div><!--mvp-content-body-top-->
                                                    <div class="mvp-cont-read-wrap">
                                                        <div class="mvp-cont-read-but-wrap left relative">
                                                            <span class="mvp-cont-read-but">Continue Reading</span>
                                                        </div><!--mvp-cont-read-but-wrap-->
                                                        <div id="mvp-related-posts" class="left relative">
                                                            <h3 class="mvp-widget-home-title">
                                                                <span class="mvp-widget-home-title">You may like</span>
                                                            </h3>
                                                        </div><!--mvp-related-posts-->
                                                    </div><!--mvp-cont-read-wrap-->
                                                </div><!--mvp-content-body-->
                                            </div><!--mvp-post-soc-in-->
                                        </div><!--mvp-post-soc-out-->
                                    </div><!--mvp-content-wrap-->
                                    <div id="mvp-post-add-box">
                                        <div id="mvp-post-add-wrap" class="left relative">
                                            @foreach ($related_blogs->splice(-1, 3) as $maylike)
                                                <div class="mvp-post-add-story left relative">
                                                    <div class="mvp-post-add-head left relative">
                                                        <h3 class="mvp-post-cat left relative">
                                                            <a class="mvp-post-cat-link" href="{{ route('blog_detail', $maylike->slug) }}" aria-label="Category">
                                                                <span class="mvp-post-cat left">{{ $maylike->category?->name }}</span>
                                                            </a>
                                                        </h3>
                                                        <h2 class="mvp-post-title left">{{ $maylike->title }}</h2>
                                                        <div class="mvp-author-info-wrap left relative">
                                                            <div class="mvp-author-info-thumb left relative">
                                                                <img alt="{{ $maylike->title }}" loading="lazy"
                                                                    src="{{ photo($maylike->image, 'blog') }}"
                                                                    class="avatar avatar-46 photo" height="46"
                                                                    width="46" decoding="async">
                                                            </div><!--mvp-author-info-thumb-->
                                                            <div class="mvp-author-info-text left relative text-black">
                                                                <div class="mvp-author-info-date left relative">
                                                                    <p>Published</p> <span
                                                                        class="mvp-post-date">{{ $maylike->created_at->diffForHumans() }}</span>
                                                                    <p>on</p> <span
                                                                        class="mvp-post-date">{{ $maylike->created_at?->format('F j, Y') }}</span>
                                                                </div><!--mvp-author-info-date-->
                                                                <div class="mvp-author-info-name left relative">
                                                                    <p>By</p> <span class="author-name vcard fn author"
                                                                        itemprop="name"><a
                                                                            href="{{ route('author', $maylike->author?->username ?: 'unknown') }}"
                                                                            title="Posts by Nelson Bill" rel="author">
                                                                            {{ $maylike->author?->name }}
                                                                        </a></span>
                                                                </div><!--mvp-author-info-name-->
                                                            </div><!--mvp-author-info-text-->
                                                        </div><!--mvp-author-info-wrap-->
                                                    </div><!--mvp-post-add-head-->
                                                    <div class="mvp-post-add-body left relative">
                                                        <div class="mvp-post-add-img left relative">
                                                            <img width="1600" height="928"
                                                                src="{{ photo($maylike->image, 'blog') }}"
                                                                class="attachment- size- wp-post-image"
                                                                alt="{{ $maylike->title }}" decoding="async"
                                                                loading="lazy">
                                                        </div><!--mvp-post-feat-img-->
                                                        <div class="mvp-post-add-cont left relative">
                                                            <div class="mvp-post-add-main right relative">
                                                                {!! $maylike->content !!}
                                                            </div><!--mvp-post-add-main-->
                                                            <div class="mvp-post-add-link">
                                                                <a href="{{ route('blog_detail', $maylike->slug) }}"
                                                                    rel="bookmark"><span
                                                                        class="mvp-post-add-link-but">Continue
                                                                        Reading</span></a>
                                                            </div><!--mvp-post-add-link-->
                                                        </div><!--mvp-post-add-cont-->
                                                    </div><!--mvp-post-add-body-->
                                                </div><!--mvp-post-add-story-->
                                            @endforeach

                                        </div><!--mvp-post-add-wrap-->
                                    </div><!--mvp-post-add-box-->
                                </div><!--mvp-post-content-->
                            </div><!--mvp-post-main-in-->
                            <div id="mvp-side-wrap" class="left relative theiaStickySidebar">
                            </div><!--mvp-side-wrap-->
                        </div><!--mvp-post-main-out-->
                    </div><!--mvp-post-main-->
                    <div id="mvp-post-more-wrap" class="left relative" style="margin-top: 40px;">
                        <h4 class="mvp-widget-home-title">
                            <span class="mvp-widget-home-title">Trending</span>
                        </h4>
                        <ul class="mvp-post-more-list left relative">
                            @foreach ($related_blogs as $trending)
                                <a href="{{ route('blog_detail', $trending->slug) }}" rel="bookmark"
                                    aria-label="Trending">
                                    <li>
                                        <div class="mvp-post-more-img left relative">
                                            <img width="400" height="240"
                                                src="{{ photo($trending->image, 'blog') }}"
                                                class="mvp-reg-img wp-post-image" alt="{{ $trending->title }}"
                                                decoding="async" loading="lazy"
                                                sizes="auto, (max-width: 400px) 100vw, 400px">
                                            <img width="80" height="80"
                                                src="{{ photo($trending->image, 'blog') }}"
                                                class="mvp-mob-img wp-post-image" alt="{{ $trending->title }}"
                                                decoding="async" loading="lazy"
                                                sizes="auto, (max-width: 80px) 100vw, 80px">
                                        </div><!--mvp-post-more-img-->
                                        <div class="mvp-post-more-text left relative">
                                            <div class="mvp-cat-date-wrap left relative">
                                                <span
                                                    class="mvp-cd-cat left relative">{{ $trending->category->name }}</span><span
                                                    class="mvp-cd-date left relative">{{ $trending->created_at?->diffForHumans() }}</span>
                                            </div><!--mvp-cat-date-wrap-->
                                            <p>{{ $trending->title }}</p>
                                        </div><!--mvp-post-more-text-->
                                    </li>
                                </a>
                            @endforeach

                        </ul>
                    </div><!--mvp-post-more-wrap-->
                </div><!--mvp-main-box-->
            </div><!--mvp-article-cont-->
        </article><!--mvp-article-wrap-->
    </div>
@endsection

@push('css')
    <style>
        .text-black {
            color: black !important;
        }
    </style>
@endpush

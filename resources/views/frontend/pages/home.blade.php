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
    Home
@endpush

@push('css')
    <style>
        .font-size-14px{
            font-size: 14px !important;
        }
        .mb-9px{
            margin-bottom: 8px !important;
        }
    </style>
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
    <meta property="og:title" content="{{ $og_title }}" />
    <meta property="og:description" content="{{ $og_description }}" />
    <meta property="og:image" content="{{ $og_img }}" />
    <meta property="og:image:alt" content="{{ $og_site_name }}">
    <meta property="og:locale" content="en_US" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $og_title }}" />
    <meta name="twitter:description" content="{{ $og_description }}" />
    <meta name="twitter:image" content="{{ $og_img }}" />
@endpush

@push('seo_schema')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [
                {
                    "@type": "WebSite",
                    "url": "{{ url('/') }}",
                    "name": "{{$og_site_name }}",
                    "potentialAction": {
                        "@type": "SearchAction",
                        "target": "https://msnworld.net/blog-search?search={search_term_string}",
                        "query-input": "required name=search"
                    }
                },
                {
                    "@type": "Organization",
                    "name": "{{$og_site_name }}",
                    "url": "{{ url('/') }}",
                    @if($db_data_cached->site_info?->site_logo)
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset($db_data_cached->site_info?->site_logo) }}"
                    },
                    @endif
                    @php
                        $sameAsLinks = array_filter([
                            $db_data_cached->site_contact?->fb_url,
                            $db_data_cached->site_contact?->twitter_url,
                            $db_data_cached->site_contact?->linkedin_url
                        ]);
                    @endphp
                    @if(count($sameAsLinks))
                    "sameAs": {!! json_encode(array_values(array_unique($sameAsLinks)), JSON_UNESCAPED_SLASHES) !!}
                    @endif
                },
                {
                    "@type": "CollectionPage",
                    "name": "{{$og_site_name }}",
                    "url": "{{ url('/') }}",
                    "description": "{{ $og_description ?? 'Welcome to ' .$og_site_name . ', your source for curated blog content' }}"
                }
            ]
        }
    </script>
@endpush

@section('content')
    <div id="mvp-main-body-wrap" class="left relative">
        <div class="mvp-main-box">
            <section id="mvp-feat1-wrap" class="left relative">
                <div class="mvp-feat1-right-out left relative">
                    <div class="mvp-feat1-right-in">
                        <div class="mvp-feat1-main left relative">
                            <div class="mvp-feat1-left-wrap relative">
                                @foreach ($sliders->splice(-1,1) as $slider1)
                                    <a href="{{route('blog_detail',$slider1->slug)}}"
                                        rel="bookmark">
                                        <div class="mvp-feat1-feat-wrap left relative">
                                            <div class="mvp-feat1-feat-img left relative">
                                                <img width="560" height="600"
                                                    src="{{ photo($slider1->image,'blog')}}"
                                                    class="attachment-mvp-port-thumb size-mvp-port-thumb wp-post-image"
                                                    alt="{{$slider1->title}}"
                                                    decoding="async" loading="lazy" />
                                            </div><!--mvp-feat1-feat-img-->
                                            <div class="mvp-feat1-feat-text left relative">
                                                <div class="mvp-cat-date-wrap left relative">
                                                    <span class="mvp-cd-cat left relative">{{$slider1->category?->name}}</span><span
                                                        class="mvp-cd-date left relative">{{ $slider1->created_at?->diffForHumans() }}</span>
                                                </div><!--mvp-cat-date-wrap-->
                                                <h2 class="mvp-stand-title">
                                                    {{$slider1->title}}
                                                </h2>
                                                <p>
                                                    {{ str(strip_tags($slider1->content))->words(20) }}
                                                </p>
                                            </div><!--mvp-feat1-feat-text-->
                                        </div><!--mvp-feat1-feat-wrap-->
                                    </a>
                                @endforeach

                                <div class="mvp-feat1-sub-wrap left relative">
                                    @foreach ($sliders as $slider)
                                        <a href="{{route('blog_detail',$slider->slug)}}"
                                            rel="bookmark">
                                            <div class="mvp-feat1-sub-cont left relative">
                                                <div class="mvp-feat1-sub-img left relative">
                                                    <img width="590" height="354"
                                                        src="{{ photo($slider->image,'blog') }}"
                                                        class="mvp-reg-img wp-post-image" alt="{{$slider->title}}" decoding="async"
                                                        loading="lazy"
                                                        sizes="auto, (max-width: 590px) 100vw, 590px" />
                                                    <img width="400"
                                                        height="240"
                                                        src="{{ photo($slider->image, 'blog') }}"
                                                        class="mvp-mob-img wp-post-image" alt="{{$slider->title}}" decoding="async"
                                                        loading="lazy"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px" />
                                                </div><!--mvp-feat1-sub-img-->
                                                <div class="mvp-feat1-sub-text">
                                                    <div class="mvp-cat-date-wrap left relative">
                                                        <span class="mvp-cd-cat left relative">{{ $slider?->category?->name}}</span><span
                                                            class="mvp-cd-date left relative">{{$slider->created_at?->diffForHumans()}}</span>
                                                    </div><!--mvp-cat-date-wrap-->
                                                    <h2>
                                                        {{$slider->title}}
                                                    </h2>
                                                </div><!--mvp-feat1-sub-text-->
                                            </div><!--mvp-feat1-sub-cont-->
                                        </a>
                                    @endforeach

                                </div><!--mvp-feat1-sub-wrap-->
                            </div><!--mvp-feat1-left-wrap-->
                            <div class="mvp-feat1-mid-wrap left relative">
                                <h3 class="mvp-feat1-pop-head"><span class="mvp-feat1-pop-head">Trending</span></h3>
                                <div class="mvp-feat1-pop-wrap left relative">
                                    @foreach ($trendings as $trending)
                                        <a href="{{route('blog_detail',$trending->slug)}}"
                                            rel="bookmark">
                                            <div class="mvp-feat1-pop-cont left relative">
                                                <div class="mvp-feat1-pop-img left relative">
                                                    <img width="400" height="240"
                                                        src="{{photo($trending->image,'blog')}}"
                                                        class="mvp-reg-img wp-post-image" alt="{{$trending->title}}" loading="lazy" decoding="async"
                                                        sizes="(max-width: 400px) 100vw, 400px" />
                                                    <img width="80"
                                                        height="80"
                                                        src="{{ photo($trending->image,'blog')}}"
                                                        class="mvp-mob-img wp-post-image" alt="{{$trending->title}}" loading="lazy" decoding="async"
                                                        sizes="(max-width: 80px) 100vw, 80px" />
                                                </div><!--mvp-feat1-pop-img-->
                                                <div class="mvp-feat1-pop-text left relative">
                                                    <div class="mvp-cat-date-wrap left relative">
                                                        <span class="mvp-cd-cat left relative">{{$trending->category?->name}}</span><span
                                                            class="mvp-cd-date left relative"> {{ $trending->created_at?->diffForHumans()}} </span>
                                                    </div><!--mvp-cat-date-wrap-->
                                                    <h2>
                                                        {{ $trending->title }}
                                                    </h2>
                                                </div><!--mvp-feat1-pop-text-->
                                            </div><!--mvp-feat1-pop-cont-->
                                        </a>
                                    @endforeach

                                </div><!--mvp-feat1-pop-wrap-->
                            </div><!--mvp-feat1-mid-wrap-->
                        </div><!--mvp-feat1-main-->
                    </div><!--mvp-feat1-right-in-->
                    <div class="mvp-feat1-right-wrap left relative">
                        <div class="mvp-feat1-list-wrap left relative">
                            <div class="mvp-feat1-list-head-wrap left relative">
                                <ul class="mvp-feat1-list-buts left relative">
                                    <li class="mvp-feat-col-tab"><a href="#mvp-feat-tab-col1"><span
                                                class="mvp-feat1-list-but">Latest</span></a></li>
                                </ul>
                            </div><!--mvp-feat1-list-head-wrap-->
                            <div id="mvp-feat-tab-col1" class="mvp-feat1-list left relative mvp-tab-col-cont">
                                @foreach ($latest_blogs->splice(0,1) as $latest_blog1)
                                    <a href="{{route('blog_detail',$latest_blog1->slug)}}"
                                        rel="bookmark">
                                        <div class="mvp-feat1-list-cont left relative">
                                            <div class="mvp-feat1-list-text">
                                                <div class="mvp-cat-date-wrap left relative">
                                                    <span class="mvp-cd-cat left relative">{{ $latest_blog1->category?->name }}</span><span
                                                        class="mvp-cd-date left relative">{{ $latest_blog1->created_at?->diffForHumans() }}</span>
                                                </div><!--mvp-cat-date-wrap-->
                                                <h2 class="font-size-14px">{{ $latest_blog1->title }}</h2>
                                            </div><!--mvp-feat1-list-text-->
                                        </div><!--mvp-feat1-list-cont-->
                                    </a>
                                @endforeach

                                @foreach ($latest_blogs->splice(0, 11) as $latest_blog2)
                                    <a href="{{route('blog_detail',$latest_blog2->slug)}}"
                                        rel="bookmark">
                                        <div class="mvp-feat1-list-cont left relative mb-9px">
                                            <div class="mvp-feat1-list-out relative">
                                                <div class="mvp-feat1-list-img left relative">
                                                    <img width="80" height="80"
                                                        src="{{ photo($latest_blog2->image,'slug')}}"
                                                        class="attachment-mvp-small-thumb size-mvp-small-thumb wp-post-image"
                                                        alt="{{ $latest_blog2->title }}" decoding="async" loading="lazy"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px" />
                                                </div><!--mvp-feat1-list-img-->
                                                <div class="mvp-feat1-list-in">
                                                    <div class="mvp-feat1-list-text">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">{{ $latest_blog2->category?->name }}</span>
                                                            <span class="mvp-cd-date left relative">{{ $latest_blog2->created_at->diffForHumans() }}</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2 class='font-size-14px'>
                                                            {{ $latest_blog2->title }}
                                                        </h2>
                                                    </div><!--mvp-feat1-list-text-->
                                                </div><!--mvp-feat1-list-in-->
                                            </div><!--mvp-feat1-list-out-->
                                        </div><!--mvp-feat1-list-cont-->
                                    </a>
                                @endforeach

                            </div><!--mvp-feat-tab-col1-->
                            <div id="mvp-feat-tab-col2" class="mvp-feat1-list left relative mvp-tab-col-cont">
                            </div><!--mvp-feat-tab-col2-->
                            <div id="mvp-feat-tab-col3" class="mvp-feat1-list left relative mvp-tab-col-cont">
                            </div><!--mvp-feat-tab-col3-->
                        </div><!--mvp-feat1-list-wrap-->
                    </div><!--mvp-feat1-right-wrap-->
                </div><!--mvp-feat1-right-out-->
            </section><!--mvp-feat1-wrap-->
        </div><!--mvp-main-box-->
        <div id="mvp-home-widget-wrap" class="left relative">
            <section id="mvp_home_feat1_widget-8" class="mvp-widget-home left relative mvp_home_feat1_widget">
                <div class="mvp-main-box">
                    <div class="mvp-widget-home-head">
                        <h4 class="mvp-widget-home-title"><span class="mvp-widget-home-title">GAMING</span>
                        </h4>
                    </div>
                    <div class="mvp-widget-feat1-wrap left relative">
                        <div class="mvp-widget-feat1-cont left relative">
                            @foreach ($gaming_blogs->splice(0,2) as $gaming_blog1)
                                <a href="{{route('blog_detail',$gaming_blog1->slug)}}"
                                    rel="bookmark">
                                    <div class="mvp-widget-feat1-top-story left relative">
                                        <div class="mvp-widget-feat1-top-img left relative">
                                            <img width="590" height="354"
                                                src="{{ photo($gaming_blog1->image,'blog')}}"
                                                class="mvp-reg-img lazy wp-post-image" alt="{{ $gaming_blog1->title }}" loading="lazy"  decoding="async"
                                                sizes="(max-width: 590px) 100vw, 590px" />
                                            <img width="400" height="240"
                                                src="{{ photo($gaming_blog1->image,'blog')}}"
                                                class="mvp-mob-img lazy wp-post-image" alt="{{ $gaming_blog1->title }}" loading="lazy" decoding="async"
                                                sizes="(max-width: 400px) 100vw, 400px" />
                                        </div><!--mvp-widget-feat1-top-img-->
                                        <div class="mvp-widget-feat1-top-text left relative">
                                            <div class="mvp-cat-date-wrap left relative">
                                                <span class="mvp-cd-cat left relative">{{ $gaming_blog1->category?->name }}</span><span
                                                    class="mvp-cd-date left relative">{{ $gaming_blog1->created_at?->diffForHumans() }}</span>
                                            </div><!--mvp-cat-date-wrap-->
                                            <h2>
                                                {{ $gaming_blog1->title }}
                                            </h2>
                                        </div><!--mvp-widget-feat1-top-text-->
                                    </div><!--mvp-widget-feat1-top-story-->
                                </a>
                            @endforeach

                        </div><!--mvp-widget-feat1-cont-->
                        <div class="mvp-widget-feat1-cont left relative">
                            @foreach ($gaming_blogs as $gaming_blog2)
                                <a href="{{route('blog_detail',$gaming_blog2->slug)}}"
                                    rel="bookmark">
                                    <div class="mvp-widget-feat1-bot-story left relative">
                                        <div class="mvp-widget-feat1-bot-img left relative">
                                            <img width="400" height="240"
                                                src="{{ photo($gaming_blog2->image,'blog')}}"
                                                class="mvp-reg-img lazy wp-post-image" alt="{{$gaming_blog2->title}}" loading="lazy" decoding="async"
                                                sizes="(max-width: 400px) 100vw, 400px" />
                                            <img width="80" height="80"
                                                src="{{ photo($gaming_blog2->image,'blog')}}"
                                                class="mvp-mob-img lazy wp-post-image" alt="{{$gaming_blog2->title}}" loading="lazy" decoding="async"
                                                sizes="(max-width: 80px) 100vw, 80px" />
                                        </div><!--mvp-widget-feat1-bot-img-->
                                        <div class="mvp-widget-feat1-bot-text left relative">
                                            <div class="mvp-cat-date-wrap left relative">
                                                <span class="mvp-cd-cat left relative">{{$gaming_blog2->category?->name}}</span><span
                                                    class="mvp-cd-date left relative">{{$gaming_blog2->created_at?->diffForHumans()}}</span>
                                            </div><!--mvp-cat-date-wrap-->
                                            <h2>{{$gaming_blog2->title}}</h2>
                                        </div><!--mvp-widget-feat1-bot-text-->
                                    </div><!--mvp-widget-feat1-bot-story-->
                                </a>
                            @endforeach
                        </div><!--mvp-widget-feat1-cont-->
                    </div><!--mvp-widget-feat1-wrap-->

                </div>
            </section>
            <section id="mvp_home_feat1_widget-4" class="mvp-widget-home left relative mvp_home_feat1_widget">
                <div class="mvp-main-box">
                    <div class="mvp-widget-home-head">
                        <h4 class="mvp-widget-home-title"><span class="mvp-widget-home-title">TECH</span>
                        </h4>
                    </div>
                    <div class="mvp-widget-feat1-wrap left relative">
                        <div class="mvp-widget-feat1-cont left relative">
                            @foreach ($techs->splice(0,2) as $tech1)
                                <a href="{{route('blog_detail',$tech1->slug)}}"
                                    rel="bookmark">
                                    <div class="mvp-widget-feat1-top-story left relative">
                                        <div class="mvp-widget-feat1-top-img left relative">
                                            <img width="590" height="354"
                                                src="{{ photo($tech1->image,'blog')}}"
                                                class="mvp-reg-img lazy wp-post-image" alt="{{ $tech1->title }}" loading="lazy" decoding="async"
                                                sizes="(max-width: 590px) 100vw, 590px" />
                                            <img width="400" height="240"
                                                src="{{ photo($tech1->image,'blog')}}"
                                                class="mvp-mob-img lazy wp-post-image" alt="{{ $tech1->title }}" loading="lazy" decoding="async"
                                                sizes="(max-width: 400px) 100vw, 400px" />
                                        </div><!--mvp-widget-feat1-top-img-->
                                        <div class="mvp-widget-feat1-top-text left relative">
                                            <div class="mvp-cat-date-wrap left relative">
                                                <span class="mvp-cd-cat left relative">{{ $tech1->category?->name }}</span><span
                                                    class="mvp-cd-date left relative">{{ $tech1->created_at?->diffForHumans() }}</span>
                                            </div><!--mvp-cat-date-wrap-->
                                            <h2>
                                                {{ $tech1->title }}
                                            </h2>
                                        </div><!--mvp-widget-feat1-top-text-->
                                    </div><!--mvp-widget-feat1-top-story-->
                                </a>
                            @endforeach

                        </div><!--mvp-widget-feat1-cont-->
                        <div class="mvp-widget-feat1-cont left relative">
                            @foreach ($techs as $tech2)
                                <a href="{{route('blog_detail',$tech2->slug)}}"
                                    rel="bookmark">
                                    <div class="mvp-widget-feat1-bot-story left relative">
                                        <div class="mvp-widget-feat1-bot-img left relative">
                                            <img width="400" height="240"
                                                src="{{ photo($tech2->image,'blog')}}"
                                                class="mvp-reg-img lazy wp-post-image" alt="{{$tech2->title}}" loading="lazy" decoding="async"
                                                sizes="(max-width: 400px) 100vw, 400px" />
                                            <img width="80" height="80"
                                                src="{{ photo($tech2->image,'blog')}}"
                                                class="mvp-mob-img lazy wp-post-image" alt="{{$tech2->title}}" loading="lazy" decoding="async"
                                                sizes="(max-width: 80px) 100vw, 80px" />
                                        </div><!--mvp-widget-feat1-bot-img-->
                                        <div class="mvp-widget-feat1-bot-text left relative">
                                            <div class="mvp-cat-date-wrap left relative">
                                                <span class="mvp-cd-cat left relative">{{$tech2->category?->name}}</span><span
                                                    class="mvp-cd-date left relative">{{$tech2->created_at?->diffForHumans()}}</span>
                                            </div><!--mvp-cat-date-wrap-->
                                            <h2>{{$tech2->title}}</h2>
                                        </div><!--mvp-widget-feat1-bot-text-->
                                    </div><!--mvp-widget-feat1-bot-story-->
                                </a>
                            @endforeach

                        </div><!--mvp-widget-feat1-cont-->
                    </div><!--mvp-widget-feat1-wrap-->

                </div>
            </section>
            {{-- <section id="mvp_home_feat1_widget-6" class="mvp-widget-home left relative mvp_home_feat1_widget">
                <div class="mvp-main-box">
                    <div class="mvp-widget-home-head">
                        <h4 class="mvp-widget-home-title"><span class="mvp-widget-home-title">ENTERTAINMENT</span></h4>
                    </div>
                    <div class="mvp-widget-feat1-wrap left relative">
                        <div class="mvp-widget-feat1-cont left relative">
                            @foreach ($entertainment_blogs->splice(0,2) as $entertainment_blog1)
                                <a href="{{route('blog_detail',$entertainment_blog1->slug)}}"
                                    rel="bookmark">
                                    <div class="mvp-widget-feat1-top-story left relative">
                                        <div class="mvp-widget-feat1-top-img left relative">
                                            <img width="590" height="354"
                                                src="{{ photo($entertainment_blog1->image,'blog')}}"
                                                class="mvp-reg-img lazy wp-post-image" alt="{{ $entertainment_blog1->title }}" loading="lazy" decoding="async"
                                                sizes="(max-width: 590px) 100vw, 590px" />
                                            <img width="400" height="240"
                                                src="{{ photo($entertainment_blog1->image,'blog')}}"
                                                class="mvp-mob-img lazy wp-post-image" alt="{{ $entertainment_blog1->title }}" loading="lazy" decoding="async"
                                                sizes="(max-width: 400px) 100vw, 400px" />
                                        </div><!--mvp-widget-feat1-top-img-->
                                        <div class="mvp-widget-feat1-top-text left relative">
                                            <div class="mvp-cat-date-wrap left relative">
                                                <span class="mvp-cd-cat left relative">{{ $entertainment_blog1->category?->name }}</span><span
                                                    class="mvp-cd-date left relative">{{ $entertainment_blog1->created_at?->diffForHumans() }}</span>
                                            </div><!--mvp-cat-date-wrap-->
                                            <h2>
                                                {{ $entertainment_blog1->title }}
                                            </h2>
                                        </div><!--mvp-widget-feat1-top-text-->
                                    </div><!--mvp-widget-feat1-top-story-->
                                </a>
                            @endforeach

                        </div><!--mvp-widget-feat1-cont-->
                        <div class="mvp-widget-feat1-cont left relative">
                            @foreach ($entertainment_blogs as $entertainment_blog2)
                                <a href="{{route('blog_detail',$entertainment_blog2->slug)}}"
                                    rel="bookmark">
                                    <div class="mvp-widget-feat1-bot-story left relative">
                                        <div class="mvp-widget-feat1-bot-img left relative">
                                            <img width="400" height="240"
                                                src="{{ photo($entertainment_blog2->image,'blog')}}"
                                                class="mvp-reg-img lazy wp-post-image" alt="{{$entertainment_blog2->title}}" loading="lazy" decoding="async"
                                                sizes="(max-width: 400px) 100vw, 400px" />
                                            <img width="80" height="80"
                                                src="{{ photo($entertainment_blog2->image,'blog')}}"
                                                class="mvp-mob-img lazy wp-post-image" alt="{{$entertainment_blog2->title}}" loading="lazy" decoding="async"
                                                sizes="(max-width: 80px) 100vw, 80px" />
                                        </div><!--mvp-widget-feat1-bot-img-->
                                        <div class="mvp-widget-feat1-bot-text left relative">
                                            <div class="mvp-cat-date-wrap left relative">
                                                <span class="mvp-cd-cat left relative">{{$entertainment_blog2->category?->name}}</span><span
                                                    class="mvp-cd-date left relative">{{$entertainment_blog2->created_at?->diffForHumans()}}</span>
                                            </div><!--mvp-cat-date-wrap-->
                                            <h2>{{$entertainment_blog2->title}}</h2>
                                        </div><!--mvp-widget-feat1-bot-text-->
                                    </div><!--mvp-widget-feat1-bot-story-->
                                </a>
                            @endforeach
                        </div><!--mvp-widget-feat1-cont-->
                    </div><!--mvp-widget-feat1-wrap-->

                </div>
            </section> --}}
            <section id="mvp_home_feat1_widget-9" class="mvp-widget-home left relative mvp_home_feat1_widget">
                <div class="mvp-main-box">
                    <div class="mvp-widget-home-head">
                        <h4 class="mvp-widget-home-title"><span class="mvp-widget-home-title">SPORTS</span>
                        </h4>
                    </div>
                    <div class="mvp-widget-feat1-wrap left relative">
                        <div class="mvp-widget-feat1-cont left relative">
                            @foreach ($sports_blogs->splice(0,2) as $sports_blog1)
                                <a href="{{route('blog_detail',$sports_blog1->slug)}}"
                                    rel="bookmark">
                                    <div class="mvp-widget-feat1-top-story left relative">
                                        <div class="mvp-widget-feat1-top-img left relative">
                                            <img width="590" height="354"
                                                src="{{ photo($sports_blog1->image,'blog')}}"
                                                class="mvp-reg-img lazy wp-post-image" alt="{{ $sports_blog1->title }}" loading="lazy" decoding="async"
                                                sizes="(max-width: 590px) 100vw, 590px" />
                                            <img width="400" height="240"
                                                src="{{ photo($sports_blog1->image,'blog')}}"
                                                class="mvp-mob-img lazy wp-post-image" alt="{{ $sports_blog1->title }}" loading="lazy" decoding="async"
                                                sizes="(max-width: 400px) 100vw, 400px" />
                                        </div><!--mvp-widget-feat1-top-img-->
                                        <div class="mvp-widget-feat1-top-text left relative">
                                            <div class="mvp-cat-date-wrap left relative">
                                                <span class="mvp-cd-cat left relative">{{ $sports_blog1->category?->name }}</span><span
                                                    class="mvp-cd-date left relative">{{ $sports_blog1->created_at?->diffForHumans() }}</span>
                                            </div><!--mvp-cat-date-wrap-->
                                            <h2>
                                                {{ $sports_blog1->title }}
                                            </h2>
                                        </div><!--mvp-widget-feat1-top-text-->
                                    </div><!--mvp-widget-feat1-top-story-->
                                </a>
                            @endforeach

                        </div><!--mvp-widget-feat1-cont-->
                        <div class="mvp-widget-feat1-cont left relative">
                            @foreach ($sports_blogs as $sports_blog2)
                                <a href="{{route('blog_detail',$sports_blog2->slug)}}"
                                    rel="bookmark">
                                    <div class="mvp-widget-feat1-bot-story left relative">
                                        <div class="mvp-widget-feat1-bot-img left relative">
                                            <img width="400" height="240"
                                                src="{{ photo($sports_blog2->image,'blog')}}"
                                                class="mvp-reg-img lazy wp-post-image" alt="{{$sports_blog2->title}}" loading="lazy" decoding="async"
                                                sizes="(max-width: 400px) 100vw, 400px" />
                                            <img width="80" height="80"
                                                src="{{ photo($sports_blog2->image,'blog')}}"
                                                class="mvp-mob-img lazy wp-post-image" alt="{{$sports_blog2->title}}" loading="lazy" decoding="async"
                                                sizes="(max-width: 80px) 100vw, 80px" />
                                        </div><!--mvp-widget-feat1-bot-img-->
                                        <div class="mvp-widget-feat1-bot-text left relative">
                                            <div class="mvp-cat-date-wrap left relative">
                                                <span class="mvp-cd-cat left relative">{{$sports_blog2->category?->name}}</span><span
                                                    class="mvp-cd-date left relative">{{$sports_blog2->created_at?->diffForHumans()}}</span>
                                            </div><!--mvp-cat-date-wrap-->
                                            <h2>{{$sports_blog2->title}}</h2>
                                        </div><!--mvp-widget-feat1-bot-text-->
                                    </div><!--mvp-widget-feat1-bot-story-->
                                </a>
                            @endforeach
                        </div><!--mvp-widget-feat1-cont-->
                    </div><!--mvp-widget-feat1-wrap-->

                </div>
            </section>
        </div><!--mvp-home-widget-wrap-->
        <div class="mvp-main-blog-wrap left relative">
            <div class="mvp-main-box">
                <div class="mvp-main-blog-cont left relative">
                    <div class="mvp-widget-home-head">
                        <h4 class="mvp-widget-home-title">
                            <span class="mvp-widget-home-title">More News</span>
                        </h4>
                    </div><!--mvp-widget-home-head-->
                    <div class="mvp-main-blog-out left relative">
                        <div class="mvp-main-blog-in">
                            <div class="mvp-main-blog-body left relative">
                                <ul class="mvp-blog-story-list-col left relative infinite-content">
                                    @foreach ($latest_blogs->splice(0,1) as $latest_blog3)
                                        <li class="mvp-blog-story-col left relative infinite-post">
                                            <a href="{{route('blog_detail',$latest_blog3->slug)}}"
                                                rel="bookmark">
                                                <div class="mvp-blog-story-text left relative">
                                                    <div class="mvp-cat-date-wrap left relative">
                                                        <span class="mvp-cd-cat left relative">{{ $latest_blog3->category?->name}}</span><span
                                                            class="mvp-cd-date left relative">
                                                            {{ $latest_blog3->created_at?->diffForHumans()}}
                                                        </span>
                                                    </div><!--mvp-cat-date-wrap-->
                                                    <h2>{{ $latest_blog3->title }}</h2>
                                                    <p>
                                                        {!! str(strip_tags($latest_blog3->content))->words(20) !!}
                                                    </p>
                                                </div><!--mvp-blog-story-text-->
                                            </a>
                                        </li><!--mvp-blog-story-wrap-->
                                    @endforeach
                                    @foreach ($latest_blogs as $latest_blog4)
                                    <li class="mvp-blog-story-col left relative infinite-post">
                                        <a href="{{route('blog_detail',$latest_blog4->slug)}}"
                                            rel="bookmark">
                                            <div class="mvp-blog-story-out relative">
                                                <div class="mvp-blog-story-img left relative">
                                                    <img width="400" height="240"
                                                        src="{{ photo($latest_blog4->image,'blog')}}"
                                                        class="mvp-reg-img wp-post-image" alt="{{$latest_blog4->title}}" decoding="async"
                                                        loading="lazy"
                                                        sizes="auto, (max-width: 400px) 100vw, 400px" />
                                                    <img width="80" height="80"
                                                        src="{{ photo($latest_blog4->image,'blog')}}"
                                                        class="mvp-mob-img wp-post-image" alt="{{$latest_blog4->title}}" decoding="async"
                                                        loading="lazy"
                                                        sizes="auto, (max-width: 80px) 100vw, 80px" />
                                                </div><!--mvp-blog-story-img-->
                                                <div class="mvp-blog-story-in">
                                                    <div class="mvp-blog-story-text left relative">
                                                        <div class="mvp-cat-date-wrap left relative">
                                                            <span class="mvp-cd-cat left relative">{{ $latest_blog4->category?->name }}</span><span
                                                                class="mvp-cd-date left relative"> {{$latest_blog4->created_at?->diffForHumans()}}</span>
                                                        </div><!--mvp-cat-date-wrap-->
                                                        <h2>
                                                            {{$latest_blog4->title}}
                                                        </h2>
                                                        <p>
                                                            {!! str(strip_tags($latest_blog4->content))->words(20) !!}
                                                        </p>
                                                    </div><!--mvp-blog-story-text-->
                                                </div><!--mvp-blog-story-in-->
                                            </div><!--mvp-blog-story-out-->
                                        </a>
                                    </li><!--mvp-blog-story-wrap-->
                                    @endforeach

                                </ul>

                            </div><!--mvp-main-blog-body-->
                        </div><!--mvp-main-blog-in-->
                        <div id="mvp-side-wrap" class="left relative theiaStickySidebar">
                            <section id="block-104" class="mvp-side-widget widget_block widget_media_gallery">
                                <figure
                                    class="wp-block-gallery has-nested-images columns-default is-cropped wp-block-gallery-1 is-layout-flex wp-block-gallery-is-layout-flex">
                                </figure>
                            </section>
                        </div><!--mvp-side-wrap-->
                    </div><!--mvp-mmain-blog-out-->
                </div><!--mvp-main-blog-cont-->
            </div><!--mvp-main-box-->
        </div><!--mvp-main-blog-wrap-->
    </div><!--mvp-main-body-wrap-->
@endsection


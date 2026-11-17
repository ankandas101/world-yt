@php
    $db_data_cached = $cdd;
    $current_url = url()->current();
    $site_name = $db_data_cached->site_seo?->meta_title;
    $site_title = $db_data_cached->site_info?->site_tagline;
    $site_description = $db_data_cached->site_seo?->meta_description;
    $site_logo = photo($db_data_cached->site_info?->site_logo, 'logo');
    $site_keywords = $db_data_cached->site_seo?->meta_keywords;
@endphp

@extends('frontend.layout.app')

@push('title')
    ABOUT US
@endpush

@push('seo_schema')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [
                {
                    "@type": "AboutPage",
                    "name": "About Us",
                    "url": "{{ url()->current() }}",
                    "description": "{{ $site_description ?? 'Learn more about ' . $site_name }}",
                    "breadcrumb": {
                        "@id": "{{ url()->current() }}#breadcrumb"
                    }
                },
                {
                    "@type": "Organization",
                    "name": "{{ $site_name }}",
                    "url": "{{ url('/') }}",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset($site_logo) }}"
                    },
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
                    "@type": "BreadcrumbList",
                    "@id": "{{ url()->current() }}#breadcrumb",
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
                            "name": "About Us",
                            "item": "{{ url()->current() }}"
                        }
                    ]
                }
            ]
        }
    </script>
@endpush
@section('content')
    <div id="mvp-main-body-wrap" class="left relative">
        <article id="mvp-article-wrap" class="post-15 page type-page status-publish hentry" itemscope=""
            itemtype="http://schema.org/NewsArticle">
            <div id="mvp-article-cont" class="left relative">
                <div class="mvp-main-box">
                    <div id="mvp-post-main" class="left relative">
                        <header id="mvp-post-head" class="left relative">
                            <h1 class="mvp-post-title left entry-title" itemprop="headline">ABOUT US</h1>
                        </header>
                        <div class="mvp-post-main-out left relative">
                            <div class="mvp-post-main-in">
                                <div id="mvp-post-content" class="left relative">
                                    <div id="mvp-content-wrap" class="left relative">
                                        <div class="mvp-post-soc-out right relative">
                                            <div class="mvp-post-soc-wrap left relative">
                                                <ul class="mvp-post-soc-list left relative">
                                                    <a href="#"
                                                        onclick="window.open('http://www.facebook.com/sharer.php?u={{ url()->current() }}/&amp;t=ABOUT US', 'facebookShare', 'width=626,height=436'); return false;"
                                                        title="Share on Facebook">
                                                        <li class="mvp-post-soc-fb">
                                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                                        </li>
                                                    </a>
                                                    <a href="#"
                                                        onclick="window.open('http://twitter.com/intent/tweet?text=ABOUT US -&amp;url={{ url()->current() }}', 'twitterShare', 'width=626,height=436'); return false;"
                                                        title="Tweet This Post">
                                                        <li class="mvp-post-soc-twit">
                                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                                        </li>
                                                    </a>
                                                    <a href="#"
                                                        onclick="window.open('http://pinterest.com/pin/create/button/?url={{ url()->current() }}&amp;media=&amp;description=ABOUT US', 'pinterestShare', 'width=750,height=350'); return false;"
                                                        title="Pin This Post">
                                                        <li class="mvp-post-soc-pin">
                                                            <i class="fab fa-pinterest-p" aria-hidden="true"></i>
                                                        </li>
                                                    </a>
                                                    <a
                                                        href="mailto:?subject=ABOUT US&amp;BODY=I found this article interesting and thought of sharing it with you. Check it out: {{ url()->current() }}">
                                                        <li class="mvp-post-soc-email">
                                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                                        </li>
                                                    </a>
                                                </ul>
                                            </div><!--mvp-post-soc-wrap-->
                                            <div id="mvp-soc-mob-wrap">
                                                <div class="mvp-soc-mob-out left relative">
                                                    <div class="mvp-soc-mob-in">
                                                        <div class="mvp-soc-mob-left left relative">
                                                            <ul class="mvp-soc-mob-list left relative">
                                                                <a href="#"
                                                                    onclick="window.open('http://www.facebook.com/sharer.php?u={{ url()->current() }}&amp;t=ABOUT US', 'facebookShare', 'width=626,height=436'); return false;"
                                                                    title="Share on Facebook">
                                                                    <li class="mvp-soc-mob-fb">
                                                                        <i class="fab fa-facebook-f"
                                                                            aria-hidden="true"></i><span
                                                                            class="mvp-soc-mob-fb">Share</span>
                                                                    </li>
                                                                </a>
                                                                <a href="#"
                                                                    onclick="window.open('http://twitter.com/share?text=ABOUT US -&amp;url={{ url()->current() }}', 'twitterShare', 'width=626,height=436'); return false;"
                                                                    title="Tweet This Post">
                                                                    <li class="mvp-soc-mob-twit">
                                                                        <i class="fab fa-twitter"
                                                                            aria-hidden="true"></i><span
                                                                            class="mvp-soc-mob-fb">Tweet</span>
                                                                    </li>
                                                                </a>
                                                                <a href="#"
                                                                    onclick="window.open('http://pinterest.com/pin/create/button/?url={{ url()->current() }}&amp;media=&amp;description=ABOUT US', 'pinterestShare', 'width=750,height=350'); return false;"
                                                                    title="Pin This Post">
                                                                    <li class="mvp-soc-mob-pin">
                                                                        <i class="fab fa-pinterest-p"
                                                                            aria-hidden="true"></i>
                                                                    </li>
                                                                </a>
                                                                <a
                                                                    href="whatsapp://send?text=ABOUT US {{ url()->current() }}"></a>
                                                                <div class="whatsapp-share"><a
                                                                        href="whatsapp://send?text=ABOUT US {{ url()->current() }}"><span
                                                                            class="whatsapp-but1">
                                                                            <li class="mvp-soc-mob-what">
                                                                                <i class="fab fa-whatsapp"
                                                                                    aria-hidden="true"></i>
                                                                            </li>
                                                                        </span></a>
                                                                    <a
                                                                        href="mailto:?subject=ABOUT US&amp;BODY=I found this article interesting and thought of sharing it with you. Check it out: {{ url()->current() }}">
                                                                        <li class="mvp-soc-mob-email">
                                                                            <i class="fa fa-envelope"
                                                                                aria-hidden="true"></i>
                                                                        </li>
                                                                    </a>
                                                                </div>
                                                            </ul>
                                                        </div><!--mvp-soc-mob-left-->
                                                    </div><!--mvp-soc-mob-in-->
                                                    <div class="mvp-soc-mob-right left relative">
                                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                    </div><!--mvp-soc-mob-right-->
                                                </div><!--mvp-soc-mob-out-->
                                            </div><!--mvp-soc-mob-wrap-->
                                            <div class="mvp-post-soc-in">
                                                <div id="mvp-content-body" class="left-relative">
                                                    <div id="mvp-content-main" class="left relative">

                                                        <h2 class="wp-block-heading">ABOUT US</h2>



                                                        <p>Wordlenyt is an engaging platform for the readers who seek unique
                                                            and perfectly readable portals to be updated with the latest
                                                            transitions all around the world whether it is Entertainment,
                                                            Fashion, Business, Life Style, Tech, Travel or any new events
                                                            around the world. We gel well with the requirements of the
                                                            current generations with creative writing styles for each news
                                                            piece.&nbsp;<strong><a href="{{ url('/') }}/"
                                                                    data-type="link"
                                                                    data-id="{{ url('/') }}/">Wordlenyt</a></strong>&nbsp;is
                                                            where one can be assured of refreshing news with unadulterated
                                                            content right from the source.</p>



                                                        <p>Also Read:&nbsp;<strong><a
                                                                    href="{{ url('/') }}/contact-us/"
                                                                    data-type="link"
                                                                    data-id="{{ url('/') }}/contact-us/">Contact
                                                                    Us</a></strong></p>



                                                        <h2
                                                            class="wp-block-heading has-text-align-center has-black-color has-text-color has-link-color wp-elements-44716d6142a59c3ba481971d6b8818f5">
                                                            Thanks For Visiting Our Site</h2>



                                                        <h4
                                                            class="wp-block-heading has-text-align-center has-black-color has-text-color has-link-color wp-elements-edc4665a9bee6cb9a39653128dc31a09">
                                                            Have a nice day!</h4>
                                                    </div><!--mvp-content-main-->

                                                </div>
                                            </div><!--mvp-post-soc-in-->
                                        </div><!--mvp-post-soc-out-->
                                    </div><!--mvp-content-wrap-->
                                </div><!--mvp-post-content-->
                            </div><!--mvp-post-main-in-->
                            <div id="mvp-side-wrap" class="left relative theiaStickySidebar">
                            </div><!--mvp-side-wrap-->
                        </div><!--mvp-post-main-out-->
                    </div><!--mvp-post-main-->
                </div><!--mvp-main-box-->
            </div><!--mvp-article-cont-->
        </article><!--mvp-article-wrap-->
    </div>
@endsection

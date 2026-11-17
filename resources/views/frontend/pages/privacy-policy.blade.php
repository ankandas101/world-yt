@php
    $db_data_cached = $cdd;
    $current_url = url()->current();
    $site_name = $db_data_cached->site_seo?->meta_title;
    $site_title = $db_data_cached->site_info?->site_tagline;
    $site_description = $db_data_cached->site_seo?->meta_description;
    // $site_logo = photo($db_data_cached->site_info?->site_logo,'logo');
    $site_keywords = $db_data_cached->site_seo?->meta_keywords;
@endphp

@extends('frontend.layout.app')

@push('title')
    Privacy Policy
@endpush

@push('seo_schema')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [
                {
                    "@type": "WebPage",
                    "name": "Privacy Policy",
                    "url": "{{ url()->current() }}",
                    "description": "{{ $site_description ?? 'Privacy policy of ' . $site_name }}",
                    "isPartOf": {
                        "@type": "WebSite",
                        "url": "{{ url('/') }}"
                    },
                    "breadcrumb": {
                        "@id": "{{ url()->current() }}#breadcrumb"
                    }
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
                            "name": "Privacy Policy",
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
        <article id="mvp-article-wrap" class="post-1132 page type-page status-publish hentry" itemscope=""
            itemtype="http://schema.org/NewsArticle">
            <div id="mvp-article-cont" class="left relative">
                <div class="mvp-main-box">
                    <div id="mvp-post-main" class="left relative">
                        <header id="mvp-post-head" class="left relative">
                            <h1 class="mvp-post-title left entry-title" itemprop="headline">PRIVACY POLICY</h1>
                        </header>
                        <div class="mvp-post-main-out left relative">
                            <div class="mvp-post-main-in">
                                <div id="mvp-post-content" class="left relative">
                                    <div id="mvp-content-wrap" class="left relative">
                                        <div class="mvp-post-soc-out right relative">
                                            <div class="mvp-post-soc-wrap left relative">
                                                <ul class="mvp-post-soc-list left relative">
                                                    <a href="#"
                                                        onclick="window.open('http://www.facebook.com/sharer.php?u={{ url()->current() }}/&amp;t=PRIVACY POLICY', 'facebookShare', 'width=626,height=436'); return false;"
                                                        title="Share on Facebook">
                                                        <li class="mvp-post-soc-fb">
                                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                                        </li>
                                                    </a>
                                                    <a href="#"
                                                        onclick="window.open('http://twitter.com/intent/tweet?text=PRIVACY POLICY -&amp;url={{ url()->current() }}/', 'twitterShare', 'width=626,height=436'); return false;"
                                                        title="Tweet This Post">
                                                        <li class="mvp-post-soc-twit">
                                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                                        </li>
                                                    </a>
                                                    <a href="#"
                                                        onclick="window.open('http://pinterest.com/pin/create/button/?url={{ url()->current() }}/&amp;media=&amp;description=PRIVACY POLICY', 'pinterestShare', 'width=750,height=350'); return false;"
                                                        title="Pin This Post">
                                                        <li class="mvp-post-soc-pin">
                                                            <i class="fab fa-pinterest-p" aria-hidden="true"></i>
                                                        </li>
                                                    </a>
                                                    <a
                                                        href="mailto:?subject=PRIVACY POLICY&amp;BODY=I found this article interesting and thought of sharing it with you. Check it out: {{ url()->current() }}/">
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
                                                                    onclick="window.open('http://www.facebook.com/sharer.php?u={{ url()->current() }}/&amp;t=PRIVACY POLICY', 'facebookShare', 'width=626,height=436'); return false;"
                                                                    title="Share on Facebook">
                                                                    <li class="mvp-soc-mob-fb">
                                                                        <i class="fab fa-facebook-f"
                                                                            aria-hidden="true"></i><span
                                                                            class="mvp-soc-mob-fb">Share</span>
                                                                    </li>
                                                                </a>
                                                                <a href="#"
                                                                    onclick="window.open('http://twitter.com/share?text=PRIVACY POLICY -&amp;url={{ url()->current() }}/', 'twitterShare', 'width=626,height=436'); return false;"
                                                                    title="Tweet This Post">
                                                                    <li class="mvp-soc-mob-twit">
                                                                        <i class="fab fa-twitter"
                                                                            aria-hidden="true"></i><span
                                                                            class="mvp-soc-mob-fb">Tweet</span>
                                                                    </li>
                                                                </a>
                                                                <a href="#"
                                                                    onclick="window.open('http://pinterest.com/pin/create/button/?url={{ url()->current() }}/&amp;media=&amp;description=PRIVACY POLICY', 'pinterestShare', 'width=750,height=350'); return false;"
                                                                    title="Pin This Post">
                                                                    <li class="mvp-soc-mob-pin">
                                                                        <i class="fab fa-pinterest-p"
                                                                            aria-hidden="true"></i>
                                                                    </li>
                                                                </a>
                                                                <a
                                                                    href="whatsapp://send?text=PRIVACY POLICY {{ url()->current() }}/"></a>
                                                                <div class="whatsapp-share"><a
                                                                        href="whatsapp://send?text=PRIVACY POLICY {{ url()->current() }}/"><span
                                                                            class="whatsapp-but1">
                                                                            <li class="mvp-soc-mob-what">
                                                                                <i class="fab fa-whatsapp"
                                                                                    aria-hidden="true"></i>
                                                                            </li>
                                                                        </span></a>
                                                                    <a
                                                                        href="mailto:?subject=PRIVACY POLICY&amp;BODY=I found this article interesting and thought of sharing it with you. Check it out: {{ url()->current() }}/">
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

                                                        <h2 class="wp-block-heading">Who we are</h2>



                                                        <p><strong>Suggested text:&nbsp;</strong>Our website address is: <a
                                                                href="{{ url('/') }}" target="_blank"
                                                                rel="noreferrer noopener">{{ url('/') }}</a></p>



                                                        <h2 class="wp-block-heading">Comments</h2>



                                                        <p><strong>Suggested text:&nbsp;</strong>When visitors leave
                                                            comments on the site, we collect the data shown in the comments
                                                            form, as well as the visitor’s IP address and browser user agent
                                                            string, to help detect spam.</p>



                                                        <p>An anonymized string created from your email address (also called
                                                            a hash) may be provided to the Gravatar service to see if you
                                                            are using it. The Gravatar service Privacy Policy is available
                                                            here: https://automattic.com/privacy/. After approval of your
                                                            comment, your profile picture is visible to the public in the
                                                            context of your comment.</p>



                                                        <h2 class="wp-block-heading">Media</h2>



                                                        <p><strong>Suggested text:&nbsp;</strong>If you upload images to the
                                                            website, you should avoid uploading images with embedded
                                                            location data (EXIF GPS) included. Visitors can download and
                                                            extract any location data from images on the website.</p>



                                                        <h2 class="wp-block-heading">Cookies</h2>



                                                        <p><span style="box-sizing: border-box; margin: 0px; padding: 0px;"><strong>Suggested
                                                                    text:&nbsp;</strong>If you leave a comment on our site,
                                                                you may opt to save</span> your name, email address, and
                                                            website in cookies. These are for your convenience, so you do
                                                            not have to fill in your details again when you leave another
                                                            comment. These cookies will last for one year.</p>



                                                        <p>If you visit our login page, we will set a temporary cookie to
                                                            determine if your browser accepts cookies. This cookie contains
                                                            no personal data and is discarded when you close your browser.
                                                        </p>



                                                        <p>When you log in, we will set up several cookies to save your
                                                            login information and screen display choices. Login cookies last
                                                            two days, and screen options cookies last a year. If you select
                                                            “Remember Me,” your login will persist for two weeks. If you log
                                                            out of your account, the login cookies will be removed.</p>



                                                        <p>If you edit or publish an article, an additional cookie will be
                                                            saved in your browser. This cookie includes no personal data and
                                                            indicates the post ID of the article you just edited. It expires
                                                            after 1 day.</p>



                                                        <h2 class="wp-block-heading">Embedded content from other websites
                                                        </h2>



                                                        <p><strong>Suggested text:&nbsp;</strong>Articles on this site may
                                                            include embedded content (e.g., videos, images, articles, etc.).
                                                            Embedded content from other websites behaves as if the visitor
                                                            had visited the other website.</p>



                                                        <p>These websites may collect data about you, use cookies, embed
                                                            additional third-party tracking, and monitor your interaction
                                                            with that embedded content, including tracking your interaction
                                                            with the embedded content if you have an account and are logged
                                                            in to that website.</p>



                                                        <h2 class="wp-block-heading">Who do we share your data with</h2>



                                                        <p><strong>Suggested text:&nbsp;</strong>If you request a password
                                                            reset, your IP address will be included in the reset email.</p>



                                                        <h2 class="wp-block-heading">How long we retain your data</h2>



                                                        <p><strong>Suggested text:&nbsp;</strong>If you leave a comment, the
                                                            comment and its metadata are retained indefinitely. This allows
                                                            us to automatically recognize and approve any follow-up comments
                                                            instead of holding them in a moderation queue.</p>



                                                        <p>We store the personal information provided by users who register
                                                            on our website (if any) in their user profiles. All users can
                                                            see, edit, or delete their personal information at any time
                                                            (except they cannot change their username). Website
                                                            administrators can also see and edit that information.</p>



                                                        <h2 class="wp-block-heading">What rights do you have over your
                                                            data?</h2>



                                                        <p><strong>Suggested text:&nbsp;</strong>If you have an account on
                                                            this site or have left comments, you can request to receive an
                                                            exported file of the personal data we hold about you, including
                                                            any data you provided. You can also request that we erase any
                                                            personal data we hold about you. This does not include any data
                                                            we must keep for administrative, legal, or security purposes.
                                                        </p>



                                                        <h2 class="wp-block-heading">Where is your data sent</h2>



                                                        <p><strong>Suggested text:&nbsp;An automated spam detection service
                                                                may check visitors’ comments</strong>.</p>
                                                    </div><!--mvp-content-main-->

                                                </div><!--mvp-content-body-->
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

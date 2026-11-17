@php
    $db_data_cached = dbDataCached();
    $site_name = $db_data_cached->site_seo?->meta_title;
    $site_favicon = asset(photo($db_data_cached->site_info?->site_favicon,'favicon'))
@endphp

<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title>@stack('title') - Wordle NYT</title>
        <link rel="icon" href="{{ $site_favicon }}" sizes="32x32" />

        <!-- DNS Prefetch / Preconnect -->
        <meta http-equiv="x-dns-prefetch-control" content="on">
        <link rel="dns-prefetch" href="https://fonts.googleapis.com" />
        <link rel="dns-prefetch" href="https://fonts.gstatic.com" />
        <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="dns-prefetch" href="https://s.gravatar.com" />
        <link rel="dns-prefetch" href="https://www.google-analytics.com" />

        <!-- SEO -->
        <meta name="robots" content="index,follow,max-image-preview:large" />
        <meta name="google-site-verification" content="{{ $db_data_cached->site_seo?->google_search_console_verification }}" />

        @stack('meta_seo')
        @stack('seo_schema')

        <!-- Stylesheets -->
        <link rel="preload" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css?ver=6.8.2" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css?ver=6.8.2"></noscript>

        <link rel="preload" href="{{asset('asset/frontend/css/zox-box/zox-news.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{asset('asset/frontend/css/zox-box/zox-news.css')}}"></noscript>

        <link rel="stylesheet" href="{{asset('asset/frontend/css/global.min.css')}}" >

        <link rel="stylesheet" href="{{asset('asset/frontend/css/home-custom-style.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{asset('asset/frontend/css/home-custom-style.css')}}"></noscript>

        <link rel="preload" href="{{asset('asset/frontend/css/zox-box/zox-box-reset.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{asset('asset/frontend/css/zox-box/zox-box-reset.css')}}"></noscript>

        <link rel="preload" href="{{asset('asset/frontend/css/zox-box/font-awesome.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{asset('asset/frontend/css/zox-box/font-awesome.css')}}"></noscript>

        <link rel="preload" href="{{asset('asset/frontend/css/zox-box/media-query.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{asset('asset/frontend/css/zox-box/media-query.css')}}"></noscript>

        <!-- Google Fonts -->
        <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&family=Oswald:wght@400;700&family=Open+Sans:wght@700&display=swap" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&family=Oswald:wght@400;700&family=Open+Sans:wght@700&display=swap" rel="stylesheet"></noscript>

        <!-- Scripts -->
        <script src="{{asset('asset/frontend/js/jQuery/jquery.min.js')}}"></script>
        <script src="{{asset('asset/frontend/js/jquery-migrate.min.js')}}" id="jquery-migrate-js" defer></script>
        <style>
            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
            }

            .sr-only:active,
            .sr-only:focus,
            .sr-only:hover {
                position: static;
            }
        </style>
        @stack('css')
    </head>


    <body class="home wp-singular page-template-default page page-id-2354 wp-embed-responsive wp-theme-zox-news">
        <div id="mvp-fly-wrap">
            <div id="mvp-fly-menu-top" class="left relative">
                <div class="mvp-fly-top-out left relative">
                    <div class="mvp-fly-top-in">
                        <div id="mvp-fly-logo" class="left relative">
                            <a href="{{ url('/') }}" aria-label="Site logo image"><img
                                    src="{{ photo($cdd->site_info?->site_logo,'logo') }}"
                                    alt="Wordle NYT" data-rjs="2" /></a>
                        </div><!--mvp-fly-logo-->
                    </div><!--mvp-fly-top-in-->
                    <div class="mvp-fly-but-wrap mvp-fly-but-menu mvp-fly-but-click">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div><!--mvp-fly-but-wrap-->
                </div><!--mvp-fly-top-out-->
            </div><!--mvp-fly-menu-top-->

            <div id="mvp-fly-menu-wrap">
                <nav class="mvp-fly-nav-menu left relative">
                    <div class="menu">
                        <ul>
                            <li class="page_item page-item-7"><a href="{{ route('about_us') }}">ABOUT US</a></li>
                            <li class="page_item page-item-9"><a href="{{ route('contact_us') }}">CONTACT US</a>
                            </li>
                            <li class="page_item page-item-2354 current_page_item"><a href="{{ url('/') }}"
                                    aria-current="page">HOME</a></li>
                            <li class="page_item page-item-1132"><a href="{{ route('privacy_policy') }}">PRIVACY
                                    POLICY</a></li>
                            <li class="page_item page-item-15"><a href="{{ route('write_for_us') }}">WRITE FOR
                                    US</a></li>
                        </ul>
                    </div>
                </nav>
            </div><!--mvp-fly-menu-wrap-->

            <div id="mvp-fly-soc-wrap">
                <span class="mvp-fly-soc-head">Connect with us</span>
                <ul class="mvp-fly-soc-list left relative">
                    <li>
                        <a href="{{$cdd->site_contact->fb_url}}" target="_blank" aria-label="Facebook page"
                            class="fab fa-facebook-f"></a>
                        </li>
                    <li>
                        <a href="https://www.youtube.com/" target="_blank" class="fab fa-youtube" aria-label="YouTube Link"></a>
                    </li>
                </ul>
            </div><!--mvp-fly-soc-wrap-->
        </div><!--mvp-fly-wrap-->

        <div id="mvp-site" class="left relative">
            <div id="mvp-search-wrap">
                <div id="mvp-search-box">
                    <form method="get" id="searchform" action="{{ route('blog_search') }}">
                        <label for="s" class="sr-only">Search</label>
                        <input type="text" name="text" id="s"  />
                    </form>
                </div><!--mvp-search-box-->
                <div class="mvp-search-but-wrap mvp-search-click">
                    <span></span>
                    <span></span>
                </div><!--mvp-search-but-wrap-->
            </div><!--mvp-search-wrap-->
            <div id="mvp-site-wall" class="left relative">
                <div id="mvp-site-main" class="left relative">
                    @include('frontend.layout.header')

                    @yield('content')

                    @include('frontend.layout.footer')
                </div><!--mvp-site-main-->
            </div><!--mvp-site-wall-->
        </div><!--mvp-site-->
        <div class="mvp-fly-top back-to-top">
            <i class="fa fa-angle-up fa-3"></i>
        </div><!--mvp-fly-top-->
        <div class="mvp-fly-fade mvp-fly-but-click">
        </div><!--mvp-fly-fade-->

        <div data-theiaStickySidebar-sidebarSelector='"#secondary, #sidebar, .sidebar, #primary"'
            data-theiaStickySidebar-options='{"containerSelector":"","additionalMarginTop":0,"additionalMarginBottom":0,"updateSidebarHeight":false,"minWidth":0,"sidebarBehavior":"modern","disableOnResponsiveLayouts":true}'>
        </div>
        <style id='core-block-supports-inline-css' type='text/css'>
            .wp-block-gallery.wp-block-gallery-1 {
                --wp--style--unstable-gallery-gap: var(--wp--style--gallery-gap-default, var(--gallery-block--gutter-size, var(--wp--style--block-gap, 0.5em)));
                gap: var(--wp--style--gallery-gap-default, var(--gallery-block--gutter-size, var(--wp--style--block-gap, 0.5em)));
            }
        </style>

        <script src="{{ asset('asset/frontend/js/theia-sticky-sidebar/ResizeSensor.js') }}" defer></script>
        <script src="{{ asset('asset/frontend/js/theia-sticky-sidebar/theia-sticky-sidebar.js') }}" defer></script>
        <script src="{{ asset('asset/frontend/js/theia-sticky-sidebar/main.js') }}" defer></script>

        <script src="{{ asset('asset/frontend/js/jQuery/core-ui.min.js') }}" defer></script>
        <script src="{{ asset('asset/frontend/js/jQuery/jquery.sticky-kit.min.js') }}" defer></script>
        <script src="{{ asset('asset/frontend/js/jQuery/jquery.waypoints.min.js') }}" defer></script>

        <script src="{{ asset('asset/frontend/js/custome.js') }}" defer></script>
        <script src="{{ asset('asset/frontend/js/zox-news/script.js') }}" defer></script>
        {{-- <script src="{{ asset('asset/frontend/js/zox-news/retina.js') }}" defer></script> --}}
        <script src="{{ asset('asset/frontend/js/zox-news/infinitescroll.min.js') }}" defer></script>

        <script src="{{ asset('asset/frontend/js/comment-reply.min.js') }}" async></script>



        @stack('js')

    </body>

</html>

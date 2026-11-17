<header id="mvp-main-head-wrap" class="left relative">
    <nav id="mvp-main-nav-wrap" class="left relative">
        <div id="mvp-main-nav-top" class="left relative">
            <div class="mvp-main-box">
                <div id="mvp-nav-top-wrap" class="left relative">
                    <div class="mvp-nav-top-right-out left relative">
                        <div class="mvp-nav-top-right-in">
                            <div class="mvp-nav-top-cont left relative">
                                <div class="mvp-nav-top-left-out relative">
                                    <div class="mvp-nav-top-left">
                                        <div class="mvp-nav-soc-wrap">
                                            <a href="{{$cdd->site_contact->fb_url}}" aria-label="Facebook page"
                                                target="_blank"><span
                                                    class="mvp-nav-soc-but fab fa-facebook-f"></span></a>
                                            <a href="https://www.youtube.com/" target="_blank" aria-label="YouTube Link"><span
                                                    class="mvp-nav-soc-but fab fa-youtube"></span></a>
                                        </div><!--mvp-nav-soc-wrap-->
                                        <div class="mvp-fly-but-wrap mvp-fly-but-click left relative">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div><!--mvp-fly-but-wrap-->
                                    </div><!--mvp-nav-top-left-->
                                    <div class="mvp-nav-top-left-in">
                                        <div class="mvp-nav-top-mid left relative" itemscope
                                            itemtype="http://schema.org/Organization">
                                            <a class="mvp-nav-logo-reg" itemprop="url" href="{{ url('/') }}" aria-label="Home">
                                                <img itemprop="logo"
                                                    src="{{ photo($cdd->site_info?->site_logo,'logo') }}"
                                                    alt="Wordle NYT" data-rjs="2" />
                                            </a>
                                            <a class="mvp-nav-logo-small" href="{{url('/')}}" aria-label="Home">
                                                <img src="{{ photo($cdd->site_info?->site_logo,'logo') }}"
                                                    alt="Wordle NYT" data-rjs="2" />
                                            </a>
                                            @if(request()->url() == url('/'))
                                                <h1 class="mvp-logo-title">{{ $cdd->site_info?->site_name }}</h1>
                                            @else
                                                <h2 class="mvp-logo-title">{{ $cdd->site_info?->site_name }}</h2>
                                            @endif
                                        </div><!--mvp-nav-top-mid-->
                                    </div><!--mvp-nav-top-left-in-->
                                </div><!--mvp-nav-top-left-out-->
                            </div><!--mvp-nav-top-cont-->
                        </div><!--mvp-nav-top-right-in-->
                        <div class="mvp-nav-top-right">
                            <span class="mvp-nav-search-but fa fa-search fa-2 mvp-search-click"></span>
                        </div><!--mvp-nav-top-right-->
                    </div><!--mvp-nav-top-right-out-->
                </div><!--mvp-nav-top-wrap-->
            </div><!--mvp-main-box-->
        </div><!--mvp-main-nav-top-->
        <div id="mvp-main-nav-bot" class="left relative">
            <div id="mvp-main-nav-bot-cont" class="left">
                <div class="mvp-main-box">
                    <div id="mvp-nav-bot-wrap" class="left">
                        <div class="mvp-nav-bot-right-out left">
                            <div class="mvp-nav-bot-right-in">
                                <div class="mvp-nav-bot-cont left">
                                    <div class="mvp-nav-bot-left-out">
                                        <div class="mvp-nav-bot-left left relative">
                                            <div class="mvp-fly-but-wrap mvp-fly-but-click left relative">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div><!--mvp-fly-but-wrap-->
                                        </div><!--mvp-nav-bot-left-->
                                        <div class="mvp-nav-bot-left-in">
                                            <div class="mvp-nav-menu left">
                                                <div class="menu-main-menu-container">
                                                    <ul id="menu-main-menu" class="menu">
                                                        <li id="menu-item-2846"
                                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-2354 current_page_item menu-item-2846">
                                                            <a rel="httpswordlenytcouk" href="{{url('/')}}" aria-label="Home"
                                                                aria-current="page">HOME</a>
                                                        </li>
                                                        @foreach ($categories->take(9) as  $category)
                                                            <li
                                                                class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2432 mvp-mega-dropdown">
                                                                <a aria-label="Category"
                                                                    href="{{ route('cat_subcat_wise_blog', $category->slug) }}">
                                                                    {{$category->name}}
                                                                </a>
                                                                @if (count($category->blogs ?: []) > 0)
                                                                    <div class="mvp-mega-dropdown">
                                                                        <div class="mvp-main-box">
                                                                            <ul class="mvp-mega-list">
                                                                                @foreach ($category->blogs as $blog)
                                                                                    <li>
                                                                                        <a aria-label="Blog Detail"
                                                                                            href="{{route('blog_detail',$blog->slug)}}">
                                                                                            <div class="mvp-mega-img">
                                                                                                <img width="400" height="240"
                                                                                                    src="{{photo($blog->image,'blog')}}"
                                                                                                    class="attachment-mvp-mid-thumb size-mvp-mid-thumb wp-post-image"
                                                                                                    alt="{{$blog->title}}"
                                                                                                    decoding="async"
                                                                                                    sizes="(max-width: 400px) 100vw, 400px" />
                                                                                            </div>
                                                                                            <p>
                                                                                                {{ $blog->title }}
                                                                                            </p>
                                                                                        </a>
                                                                                    </li>
                                                                                @endforeach


                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div><!--mvp-nav-menu-->
                                        </div><!--mvp-nav-bot-left-in-->
                                    </div><!--mvp-nav-bot-left-out-->
                                </div><!--mvp-nav-bot-cont-->
                            </div><!--mvp-nav-bot-right-in-->
                            <div class="mvp-nav-bot-right left relative">
                                <span class="mvp-nav-search-but fa fa-search fa-2 mvp-search-click"></span>
                            </div><!--mvp-nav-bot-right-->
                        </div><!--mvp-nav-bot-right-out-->
                    </div><!--mvp-nav-bot-wrap-->
                </div><!--mvp-main-nav-bot-cont-->
            </div><!--mvp-main-box-->
        </div><!--mvp-main-nav-bot-->
    </nav><!--mvp-main-nav-wrap-->
</header><!--mvp-main-head-wrap-->

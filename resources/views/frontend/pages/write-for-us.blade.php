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
    Write For Us
@endpush

@push('seo_schema')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [
                {
                    "@type": "WebPage",
                    "name": "Write For Us",
                    "url": "{{ url()->current() }}",
                    "description": "{{ $site_description ?? 'Write For Us ' . $site_name }}",
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
                            "name": "Write For Us",
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
                            <h1 class="mvp-post-title left entry-title" itemprop="headline">WRITE FOR US</h1>
                        </header>
                        <div class="mvp-post-main-out left relative">
                            <div class="mvp-post-main-in">
                                <div id="mvp-post-content" class="left relative">
                                    <div id="mvp-content-wrap" class="left relative">
                                        <div class="mvp-post-soc-out right relative">
                                            <div class="mvp-post-soc-wrap left relative">
                                                <ul class="mvp-post-soc-list left relative">
                                                    <a href="#"
                                                        onclick="window.open('http://www.facebook.com/sharer.php?u={{url()->current()}}/&amp;t=WRITE FOR US', 'facebookShare', 'width=626,height=436'); return false;"
                                                        title="Share on Facebook">
                                                        <li class="mvp-post-soc-fb">
                                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                                        </li>
                                                    </a>
                                                    <a href="#"
                                                        onclick="window.open('http://twitter.com/intent/tweet?text=WRITE FOR US -&amp;url={{url()->current()}}', 'twitterShare', 'width=626,height=436'); return false;"
                                                        title="Tweet This Post">
                                                        <li class="mvp-post-soc-twit">
                                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                                        </li>
                                                    </a>
                                                    <a href="#"
                                                        onclick="window.open('http://pinterest.com/pin/create/button/?url={{url()->current()}}&amp;media=&amp;description=WRITE FOR US', 'pinterestShare', 'width=750,height=350'); return false;"
                                                        title="Pin This Post">
                                                        <li class="mvp-post-soc-pin">
                                                            <i class="fab fa-pinterest-p" aria-hidden="true"></i>
                                                        </li>
                                                    </a>
                                                    <a
                                                        href="mailto:?subject=WRITE FOR US&amp;BODY=I found this article interesting and thought of sharing it with you. Check it out: {{url()->current()}}">
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
                                                                    onclick="window.open('http://www.facebook.com/sharer.php?u={{url()->current()}}&amp;t=WRITE FOR US', 'facebookShare', 'width=626,height=436'); return false;"
                                                                    title="Share on Facebook">
                                                                    <li class="mvp-soc-mob-fb">
                                                                        <i class="fab fa-facebook-f"
                                                                            aria-hidden="true"></i><span
                                                                            class="mvp-soc-mob-fb">Share</span>
                                                                    </li>
                                                                </a>
                                                                <a href="#"
                                                                    onclick="window.open('http://twitter.com/share?text=WRITE FOR US -&amp;url={{url()->current()}}', 'twitterShare', 'width=626,height=436'); return false;"
                                                                    title="Tweet This Post">
                                                                    <li class="mvp-soc-mob-twit">
                                                                        <i class="fab fa-twitter"
                                                                            aria-hidden="true"></i><span
                                                                            class="mvp-soc-mob-fb">Tweet</span>
                                                                    </li>
                                                                </a>
                                                                <a href="#"
                                                                    onclick="window.open('http://pinterest.com/pin/create/button/?url={{url()->current()}}&amp;media=&amp;description=WRITE FOR US', 'pinterestShare', 'width=750,height=350'); return false;"
                                                                    title="Pin This Post">
                                                                    <li class="mvp-soc-mob-pin">
                                                                        <i class="fab fa-pinterest-p"
                                                                            aria-hidden="true"></i>
                                                                    </li>
                                                                </a>
                                                                <a
                                                                    href="whatsapp://send?text=WRITE FOR US {{url()->current()}}"></a>
                                                                <div class="whatsapp-share"><a
                                                                        href="whatsapp://send?text=WRITE FOR US {{url()->current()}}"><span
                                                                            class="whatsapp-but1">
                                                                            <li class="mvp-soc-mob-what">
                                                                                <i class="fab fa-whatsapp"
                                                                                    aria-hidden="true"></i>
                                                                            </li>
                                                                        </span></a>
                                                                    <a
                                                                        href="mailto:?subject=WRITE FOR US&amp;BODY=I found this article interesting and thought of sharing it with you. Check it out: {{url()->current()}}">
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
                                                        {{-- <div class="wp-block-image">
                                                            <figure class="aligncenter size-full"><img decoding="async"
                                                                    src="https://wordlenyt.co.uk/wp-content/uploads/2024/07/Write-For-US.png"
                                                                    alt="" class="wp-image-979"></figure>
                                                        </div> --}}


                                                        <p>Are you looking to showcase your writing skills and reach a wider
                                                            audience? We welcome you to contribute to our platform by
                                                            submitting a unique and engaging article for us!</p>



                                                        <p>At WORDLENYT, we value the diverse perspectives and creative
                                                            ideas that writers like you bring. Whether you’re an experienced
                                                            writer or just starting, we encourage you to share your thoughts
                                                            on topics that resonate with our readers.</p>



                                                        <p>By becoming a contributor, you can connect with our community,
                                                            establish yourself as an industry expert, and gain exposure for
                                                            your work. Share your insights, spark meaningful conversations,
                                                            and inspire others through your writing.</p>



                                                        <p>We are always on the lookout for fresh voices and innovative
                                                            content. If you are passionate about storytelling and want to
                                                            make an impact, consider joining us as a guest writer. Your
                                                            words can inform, entertain, and inspire – so why not share them
                                                            with us?</p>



                                                        <p>Submit your pitch or completed article today and take the first
                                                            step towards becoming a part of our growing network of talented
                                                            writers!</p>



                                                        <h2 class="wp-block-heading">Requirements</h2>



                                                        <ol class="wp-block-list">
                                                            <li>Maximum 2 Dofollow Link Alow</li>



                                                            <li>Article Minimum 700 Word</li>



                                                            <li>Adult, Casino, And Gambling&nbsp;<strong>Not Allow</strong>
                                                            </li>



                                                            <li>Not Ai Only Manually Accepted</li>
                                                        </ol>



                                                        <h2 class="wp-block-heading">Category</h2>



                                                        <ol class="wp-block-list">
                                                            <li><strong>Technology</strong>: Latest gadgets, software
                                                                reviews, tech trends.</li>



                                                            <li><strong>Travel</strong>: Destination guides, travel tips,
                                                                experiences.</li>



                                                            <li><strong>Health and Wellness</strong>: Fitness routines,
                                                                mental health, nutrition.</li>



                                                            <li><strong>Fashion and Beauty</strong>: Style tips, product
                                                                reviews, trends.</li>



                                                            <li><strong>Finance</strong>: Investing strategies, personal
                                                                finance tips, saving hacks.</li>



                                                            <li><strong>Food and Cooking</strong>: Recipes, restaurant
                                                                reviews, culinary tips.</li>



                                                            <li><strong>Home Improvement</strong>: DIY projects, interior
                                                                design, gardening.</li>



                                                            <li><strong>Parenting</strong>: Tips for new parents, child
                                                                development, family activities.</li>



                                                            <li><strong>Education</strong>: Teaching strategies, learning
                                                                resources, and student tips.</li>



                                                            <li><strong>Business and Entrepreneurship</strong>: Startup
                                                                advice, leadership insights, productivity hacks.</li>



                                                            <li><strong>Marketing</strong>: Digital marketing strategies,
                                                                social media trends, SEO tips.</li>



                                                            <li><strong>Sports and Fitness</strong>: Workout routines,
                                                                sports news, athlete profiles.</li>



                                                            <li><strong>Art and Culture</strong>: Artistic inspiration,
                                                                cultural events, museum reviews.</li>



                                                            <li><strong>Science</strong>: Latest scientific discoveries,
                                                                space exploration, technology innovations.</li>



                                                            <li><strong>Environment</strong>: Sustainable living tips,
                                                                climate change discussions, eco-friendly products.</li>



                                                            <li><strong>Lifestyle</strong>: Wellness trends, productivity
                                                                tips, life hacks.</li>



                                                            <li><strong>Books and Literature</strong>: Book reviews, author
                                                                interviews, reading lists.</li>



                                                            <li><strong>Gaming</strong>: Game reviews, gaming industry news,
                                                                tips and tricks.</li>



                                                            <li><strong>Automotive</strong>: Car reviews, maintenance tips,
                                                                industry updates.</li>



                                                            <li><strong>Photography</strong>: Techniques, equipment reviews,
                                                                photo editing tips.</li>
                                                        </ol>



                                                        <p class="has-text-align-center"><strong>Also Read:&nbsp;<a
                                                                    href="https://wordlenyt.co.uk/contact-us/">Contact
                                                                    US</a></strong></p>
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

<aside class=" side-aside normal-side dark-skin dark-widgetized-area slide-sidebar-desktop is-fullwidth appear-from-left"
    aria-label="Secondary Sidebar" style="visibility: hidden;">
    <div data-height="100%" class="side-aside-wrapper has-custom-scroll">

        <a href="#" class="close-side-aside remove big-btn light-btn">
            <span class="screen-reader-text">Close</span>
        </a><!-- .close-side-aside /-->



        <div id="mobile-container">

            <div id="mobile-search">
                <form role="search" method="get" class="search-form" action="{{ url('/') }}">
                    <label>
                        <span class="screen-reader-text">Search for:</span>
                        <input type="search" class="search-field" placeholder="Search &hellip;" value=""
                            name="s" />
                    </label>
                    <input type="submit" class="search-submit" value="Search" />
                </form>
            </div><!-- #mobile-search /-->

            <div id="mobile-menu" class="hide-menu-icons">
            </div><!-- #mobile-menu /-->

            <div id="mobile-social-icons" class="social-icons-widget solid-social-icons">
                <ul>
                    <li class="social-icons-item"><a class="social-link facebook-social-icon"
                            rel="external noopener nofollow" target="_blank" href="#"><span
                                class="tie-social-icon tie-icon-facebook"></span><span
                                class="screen-reader-text">Facebook</span></a></li>
                    <li class="social-icons-item"><a class="social-link twitter-social-icon"
                            rel="external noopener nofollow" target="_blank" href="#"><span
                                class="tie-social-icon tie-icon-twitter"></span><span
                                class="screen-reader-text">Twitter</span></a></li>
                    <li class="social-icons-item"><a class="social-link youtube-social-icon"
                            rel="external noopener nofollow" target="_blank" href="#"><span
                                class="tie-social-icon tie-icon-youtube"></span><span
                                class="screen-reader-text">YouTube</span></a></li>
                    <li class="social-icons-item"><a class="social-link instagram-social-icon"
                            rel="external noopener nofollow" target="_blank" href="#"><span
                                class="tie-social-icon tie-icon-instagram"></span><span
                                class="screen-reader-text">Instagram</span></a></li>
                </ul>
            </div><!-- #mobile-social-icons /-->

        </div><!-- #mobile-container /-->


        <div id="slide-sidebar-widgets">
            <div id="categories-4" class="container-wrapper widget widget_categories">
                <div class="widget-title the-global-title">
                    <div class="the-subtitle">Categories</div>
                </div>
                <x-sidebar-category-list />

                <div class="clearfix"></div>
            </div><!-- .widget /-->
        </div>

    </div><!-- .side-aside-wrapper /-->
</aside><!-- .side-aside /-->

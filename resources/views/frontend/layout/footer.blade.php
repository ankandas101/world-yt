<footer id="mvp-foot-wrap" class="left relative">
    <div id="mvp-foot-top" class="left relative">
        <div class="mvp-main-box">
            <div id="mvp-foot-logo" class="left relative">
                <a href="{{url('/')}}" aria-label="Home"><img
                        src="{{ photo($cdd->site_info?->site_logo,'logo') }}"
                        alt="{{env('APP_NAME')}}" data-rjs="2" /></a>
            </div><!--mvp-foot-logo-->
            <div id="mvp-foot-soc" class="left relative">
                <ul class="mvp-foot-soc-list left relative">
                    <li><a href="{{$cdd->site_contact?->fb_url}}" target="_blank" aria-label="Facebook page"
                            class="fab fa-facebook-f"></a></li>
                    <li><a href="https://www.youtube.com/" target="_blank" class="fab fa-youtube" aria-label="YouTube Link"></a>
                    </li>
                </ul>
            </div><!--mvp-foot-soc-->
            <div id="mvp-foot-menu-wrap" class="left relative">
                <div id="mvp-foot-menu" class="left relative">
                    <div class="menu-footer-menu-container">
                        <ul id="menu-footer-menu" class="menu">
                            <li id="menu-item-2457"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2457">
                                <a href="{{ route('about_us') }}">ABOUT US</a>
                            </li>
                            <li id="menu-item-2456"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2456">
                                <a href="{{ route('contact_us') }}">CONTACT US</a>
                            </li>
                            <li id="menu-item-2454"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2454">
                                <a href="{{ route('privacy_policy') }}">PRIVACY POLICY</a>
                            </li>
                            <li id="menu-item-2455"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2455">
                                <a href="{{ route('write_for_us') }}">WRITE FOR US</a>
                            </li>
                        </ul>
                    </div>
                </div><!--mvp-foot-menu-->
            </div><!--mvp-foot-menu-wrap-->
        </div><!--mvp-main-box-->
    </div><!--mvp-foot-top-->
    <div id="mvp-foot-bot" class="left relative">
        <div class="mvp-main-box">
            <div id="mvp-foot-copy" class="left relative">
                <p>Copyright © {{ now()->format('Y')}} Wordle NYT . All Rights Reserved</p>
            </div><!--mvp-foot-copy-->
        </div><!--mvp-main-box-->
    </div><!--mvp-foot-bot-->
</footer>

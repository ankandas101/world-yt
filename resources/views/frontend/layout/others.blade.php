<script type="text/javascript" src="{{ asset('asset/frontend/js/theia-sticky-sidebar/ResizeSensor.js') }}"
    id="theia-sticky-sidebar/ResizeSensor.js-js"></script>

<script type="text/javascript" src="{{ asset('asset/frontend/js/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"
    id="theia-sticky-sidebar/theia-sticky-sidebar.js-js"></script>

<script type="text/javascript" src="{{ asset('asset/frontend/js/theia-sticky-sidebar/main.js') }}"
    id="theia-sticky-sidebar/main.js-js"></script>

<script type="text/javascript"
    src="{{ asset('asset/frontend/js/jQuery/jquery.sticky-kit.min.js') }}"
    id="jquery-sticky-kit-js"></script>

<script type="text/javascript" src="{{ asset('asset/frontend/js/jQuery/core-ui.min.js') }}" id="jquery-ui-core-js">
</script>

<script type="text/javascript" src="{{ asset('asset/frontend/js/jQuery/jquery.sticky-kit.min.js') }}"
    id="jquery-sticky-kit-js"></script>

<script type="text/javascript" src="{{ asset('asset/frontend/js/jQuery/jquery.waypoints.min.js') }}"
    id="jquery-waypoints-js"></script>

<script type="text/javascript" src="{{ asset('asset/frontend/js/custome.js') }}" id="mvp-custom-js"></script>

{{-- <script type="text/javascript" id="mvp-custom-js-after"> --}}
<script type="text/javascript" src="{{ asset('asset/frontend/js/zox-news/script.js') }}" id="zoxnews-js"></script>

{{-- <script type="text/javascript" src="{{ asset('asset/frontend/js/zox-news/retina.js') }}" id="retina-js"></script> --}}

<script type="text/javascript" src="{{ asset('asset/frontend/js/zox-news/infinitescroll.min.js') }}"
    id="infinitescroll-js"></script>

<script type="text/javascript" src="{{ asset('asset/frontend/js/comment-reply.min.js') }}" id="comment-reply-js"
    async="async" data-wp-strategy="async"></script>


<body>
    <div class="background-overlay">

        <div id="tie-container" class="site tie-container">


            <div id="tie-wrapper">

                @include('frontend.layout.header')
                @yield('content')
                @include('frontend.layout.footer')

            </div><!-- #tie-wrapper /-->

            @include('frontend.layout.asidebar')

        </div><!-- #tie-container /-->
    </div><!-- .background-overlay /-->

    @include('frontend.layout.others')
    {{-- @include('frontend.layout.js') --}}



    @stack('js')



</body>

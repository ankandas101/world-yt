<ul class="posts-items posts-list-container">
    @foreach (($pagination ? $blogs->items() :  $blogs) ?: [] as $blog)
        @if ($loop->first)
            <li class="post-item tie-standard">
                <div class="big-thumb-left-box-inner rounded-xl overflow-hidden shadow-md border border-purple-100"
                    style="background-image: linear-gradient(rgba(60,0,100,0.18),rgba(255,255,255,0.08)), url({{ photo($blog->image, 'blog') }})">
                    <a aria-label="{{ $blog->title }}" href="{{ route('blog_detail', $blog->slug) }}" class="post-thumb">
                        <div class="post-thumb-overlay-wrap">
                            <div class="post-thumb-overlay bg-gradient-to-t from-black/50 to-transparent">
                                <span class="tie-icon tie-media-icon"></span>
                            </div>
                        </div>
                    </a>
                    <div class="post-overlay">
                        <div class="post-content">
                            <a class="post-cat tie-cat-241 px-3 py-1 rounded-full text-white text-xs font-semibold shadow bg-gradient-to-r from-pink-500 to-purple-500 hover:from-purple-600 hover:to-blue-600 transition-colors"
                             aria-label="{{ $category = $blog->category?->name }}"
                             href="{{ route('cat_subcat_wise_blog', $blog->category->slug) }}">
                                {{ $category }}
                            </a>
                            <h2 class="post-title mt-2 mb-1 text-white text-xl font-bold drop-shadow">
                                <a href="{{ route('blog_detail', $blog->slug) }}"  aria-label="{{ $blog->title }}" class="hover:underline">
                                    {{ str($blog->title)->words(8) }}
                                </a>
                            </h2>
                            <div class="thumb-meta">
                                <div class="post-meta clearfix flex items-center gap-4 text-xs text-gray-100/90">
                                    <span class="author-meta single-author no-avatars">
                                        <span class="meta-item meta-author-wrapper meta-author-3">
                                            <span class="meta-author">
                                                <span aria-label="{{ $author_name = $blog->author?->name }}"
                                                    class="author-name tie-icon font-semibold text-blue-100 hover:text-pink-200"
                                                    title="Jason Holder">{{ $author_name }}</span>
                                            </span>
                                        </span>
                                    </span>
                                    <span
                                        class="date meta-item tie-icon text-pink-100">{{ $blog->created_at->format('d-m-Y') }}</span>
                                    <div class="tie-alignright ml-auto">
                                        <span class="meta-views meta-item text-yellow-100 flex items-center gap-1">
                                            <span class="tie-icon-fire" aria-hidden="true"></span>
                                            {{ $blog->view_count }}
                                        </span>
                                    </div>
                                </div><!-- .post-meta -->
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @else
            <li
                class="mb-8px post-item tie-standard bg-white/90 rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden border border-purple-50">
                <a aria-label="{{ $blog->title }}" href="{{ route('blog_detail', $blog->slug) }}" class="post-thumb">
                    <div class="post-thumb-overlay-wrap">
                        <div class="post-thumb-overlay bg-gradient-to-t from-black/30 to-transparent">
                            <span class="tie-icon tie-media-icon"></span>
                        </div>
                    </div>
                    <img width="220" height="150" src="{{ photo($blog->image, 'blog') }}" loading="lazy"
                        class="attachment-jannah-image-small size-jannah-image-small tie-small-image wp-post-image object-cover w-full h-[150px]"
                        alt="{{ $blog->image_alt_text }}" decoding="async" />
                </a>
                <div class="post-details p-3">
                    <div class="post-meta clearfix mb-1 text-xs text-gray-500">
                        <span
                            class="date meta-item tie-icon text-blue-500">{{ $blog->created_at->format('d-m-Y') }}</span>
                    </div><!-- .post-meta -->
                    <h2 class="post-title text-base font-semibold text-gray-800 leading-snug">
                        <a href="{{ route('blog_detail', $blog->slug) }}"
                            class="hover:text-purple-600 transition-colors"
                            aria-label="{{ $blog->title }}">
                            {{ str($blog->title)->words(18) }}
                        </a>
                    </h2>
                </div>
            </li>
        @endif
    @endforeach
</ul>

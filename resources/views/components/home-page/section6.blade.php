<ul class="posts-items posts-list-container">
    @foreach (($pagination ? $blogs->items() :  $blogs) ?: [] as $blog)
        @if ($loop->first)
            <li class="post-item tie-standard ">
                <div class="big-thumb-left-box-inner"
                    style="background-image: url({{ photo($blog->image, 'blog') }})">

                    <a aria-label="{{ $blog->title }}"
                        href="{{ route('blog_detail', $blog->slug) }}"
                        class="post-thumb">
                        <div class="post-thumb-overlay-wrap">
                            <div class="post-thumb-overlay">
                                <span
                                    class="tie-icon tie-media-icon"></span>
                            </div>
                        </div>
                    </a>
                    <div class="post-overlay">
                        <div class="post-content">
                            <a class="post-cat tie-cat-403 bgblue-white"
                                href="{{ route('blog_detail', $blog->slug) }}"
                                aria-label="{{  $category_name = $blog->category?->name }}"
                                >
                                {{ $category_name }}
                            </a>
                            <h2 class="post-title">
                                <a href="{{ route('blog_detail', $blog->slug) }}"
                                    aria-label="{{  $blog->title }}"
                                    style="color: white;">
                                    {{ $blog->title }}
                                </a>
                            </h2>
                            <div class="thumb-meta">
                                <div class="post-meta clearfix">
                                    <span
                                        class="author-meta single-author no-avatars">
                                        <span
                                            class="meta-item meta-author-wrapper meta-author-3">
                                            <span class="meta-author">
                                                <span
                                                {{-- href="{{ route('blog_detail', $blog->slug) }}" --}}
                                                    class="author-name tie-icon"
                                                    title="{{ $author_name = $blog->author?->name }}"
                                                    aria-label="{{ $author_name }}"
                                                    style="color: white;">
                                                    {{ $author_name }}
                                                </span>
                                            </span>
                                        </span>
                                    </span>
                                    <span class="date meta-item tie-icon"
                                        style="color: white;">
                                        {{ $blog->created_at->diffForHumans() }}
                                    </span>
                                    <div class="tie-alignright">
                                        <span class="meta-views meta-item"
                                            style="color: white;">
                                            <span class="tie-icon-fire"
                                                aria-hidden="true"></span>
                                            {{ $blog->view_count }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @else
            <li class="post-item  tie-standard mb-8px"
                style="border: 1px solid #3B82F6; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.1), 0 2px 4px -1px rgba(59, 130, 246, 0.06);">
                <a aria-label="{{ $blog->title }}" aria-label="{{ $blog->title }}"
                    href="{{ route('blog_detail', $blog->slug) }}"
                    class="post-thumb">
                    <div class="post-thumb-overlay-wrap">
                        <div class="post-thumb-overlay"
                            style="background-color: rgba(59, 130, 246, 0.8);">
                            <span class="tie-icon tie-media-icon"></span>
                        </div>
                    </div>
                    <img width="220" height="150" loading="lazy"
                        src="{{ photo($blog->image, 'blog') }}"
                        class="attachment-jannah-image-small size-jannah-image-small tie-small-image wp-post-image"
                        alt="{{ $blog->image_alt_text }}"
                        decoding="async" />
                </a>
                <div class="post-details">
                    <div class="post-meta clearfix">
                        <span class="date meta-item tie-icon"
                            style="color: #1E293B;">
                            {{ $blog->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <h2 class="post-title">
                        <a href="{{ route('blog_detail', $blog->slug) }}"
                             aria-label="{{ $blog->title }}"
                            style="color: #1E293B;">
                            {{ $blog->title }}
                        </a>
                    </h2>
                </div>
            </li>
        @endif
    @endforeach
</ul>

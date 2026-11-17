<ul class="posts-items posts-list-container">
    @foreach (($pagination ? $blogs->items() :  $blogs) ?: [] as $blog)
        @if ($loop->first)
            <li class="post-item tie-standard"
                style="padding:5px; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.1), 0 2px 4px -1px rgba(79, 70, 229, 0.06);">
                <a aria-label="{{ $blog->title }}"
                    href="{{ route('blog_detail', $blog->slug) }}"
                    class="post-thumb">
                    <span class="post-cat-wrap">
                        <span class="post-cat tie-cat-398"
                            style="background-color: #9333EA; color: white;">
                            {{ $blog->category?->name }}
                        </span>
                    </span>
                    <div class="post-thumb-overlay-wrap">
                        <div class="post-thumb-overlay"
                            style="background-color: rgba(79, 70, 229, 0.8);">
                            <span class="tie-icon tie-media-icon"></span>
                        </div>
                    </div>
                    <img width="390" height="220" loading="lazy"
                        src="{{ photo($blog->image, 'blog') }}"
                        class="attachment-jannah-image-large size-jannah-image-large wp-post-image"
                        alt="{{ $blog->image_alt_text }}"
                        decoding="async" />
                </a>
                <div class="post-details">
                    <div class="post-meta clearfix">
                        <span class="author-meta single-author no-avatars">
                            <span
                                class="meta-item meta-author-wrapper meta-author-3">
                                <span class="meta-author">
                                    <span
                                    {{-- href="{{ route('blog_detail', $blog->slug) }}" --}}
                                        class="author-name tie-icon"
                                        title="{{ $author_name = $blog->author?->name }}"
                                        aria-label="{{ $author_name }}"
                                        style="color: #4F46E5;">
                                        {{ $author_name }}
                                    </span>
                                </span>
                            </span>
                        </span>
                        <span class="date meta-item tie-icon"
                            style="color: #1E293B;">
                            {{ $blog->created_at->format('d/m/Y') }}
                        </span>
                        <div class="tie-alignright">
                            <span class="meta-views meta-item"
                                style="color: #1E293B;">
                                <span class="tie-icon-fire"
                                    aria-hidden="true"></span>
                                {{ $blog->view_count }}
                            </span>
                        </div>
                    </div>
                    <h2 class="post-title">
                        <a href="{{ route('blog_detail', $blog->slug) }}"
                            aria-label="{{ $blog->slug }}"
                            style="color: #1E293B;">
                            {{ str($blog->title)->words(8) }}
                        </a>
                    </h2>
                    <p class="post-excerpt" style="color: #1E293B;">
                        {!! str($blog->content)->words(50) !!}</p>
                    <a class="more-link button" aria-label="Read More"
                        href="{{ route('blog_detail', $blog->slug) }}"
                        style="background: linear-gradient(90deg, #4F46E5, #9333EA); color: white;">
                        Read More &raquo;
                    </a>
                </div>
            </li>
        @else
            <li class="post-item tie-standard mb-8px"
                style="border: 1px solid #4F46E5; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.1), 0 2px 4px -1px rgba(79, 70, 229, 0.06);">
                <a aria-label="{{ $blog->image_alt_text }}"
                    href="{{ route('blog_detail', $blog->slug) }}"
                    class="post-thumb">
                    <div class="post-thumb-overlay-wrap">
                        <div class="post-thumb-overlay"
                            style="background-color: rgba(79, 70, 229, 0.8);">
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
                            {{ $blog->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                    <h2 class="post-title">
                        <a href="{{ route('blog_detail', $blog->slug) }}"
                            aria-label="{{  $blog->title }}"
                            style="color: #1E293B;">
                            {{ str($blog->title)->words(8) }}
                        </a>
                    </h2>
                </div>
            </li>
        @endif
    @endforeach
</ul>

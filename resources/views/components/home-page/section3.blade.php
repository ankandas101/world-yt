<ul class="posts-items posts-list-container">
    @foreach (($pagination ? $blogs->items() :  $blogs) ?: [] as $blog)
        @if ($loop->first)
            <li class="post-item  tie-standard">
                <a aria-label=" {{ $blog->title }}"
                    href="{{ route('blog_detail', $blog->slug) }}"
                    class="post-thumb">
                    <span class="post-cat-wrap">
                        <span class="post-cat tie-cat-404">
                            {{ $blog->category?->name }}
                        </span>
                    </span>
                    <div class="post-thumb-overlay-wrap">
                        <div class="post-thumb-overlay">
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
                                    {{-- href="{{ route('cat_subcat_wise_blog', $blog->category?->slug) }}" --}}
                                        class="author-name tie-icon"
                                        title="{{ $author_name = $blog->author?->name }}"
                                        aria-label="{{ $author_name }}">
                                        {{ $author_name }}
                                    </span>
                                </span>
                            </span>
                        </span>
                        <span
                            class="date meta-item tie-icon">{{ $blog->created_at->format('d/m/Y') }}</span>
                        <div class="tie-alignright">
                            <span class="meta-views meta-item ">
                                <span class="tie-icon-fire"
                                    aria-hidden="true"></span>
                                {{ $blog->view_count }}
                            </span>
                        </div>
                    </div>
                    <h2 class="post-title">
                        <a href="{{ route('blog_detail', $blog->slug) }}"
                            aria-label="{{ $blog->title }}">
                            {{ str($blog->title)->words(10) }}
                        </a>
                    </h2>
                    <p class="post-excerpt">{!! str($blog->content)->words(15) !!}</p>
                    <a class="more-link button"  aria-label="Read More"
                        href="{{ route('blog_detail', $blog->slug) }}">Read
                        More &raquo;</a>
                </div>
            </li>
        @else
            <li class="post-item  tie-standard mb-8px">
                <a aria-label="{{ $blog->title }}"
                    href="{{ route('blog_detail', $blog->slug) }}"
                    class="post-thumb">
                    <div class="post-thumb-overlay-wrap">
                        <div class="post-thumb-overlay">
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
                        <span class="date meta-item tie-icon">
                            {{ $blog->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                    <h2 class="post-title"><a aria-label="{{ $blog->title }}"
                            href="{{ route('blog_detail', $blog->slug) }}">
                            {{ str($blog->title)->words(7) }}
                        </a></h2>
                </div>
            </li>
        @endif
    @endforeach
</ul>

<ul class="posts-list-container posts-list-container-latest">

    @foreach (($pagination ? $blogs->items() :  $blogs) ?: [] as $blog)
        {{-- @php
            if($dd){
                dd($blog,$blogs);
            }
        @endphp --}}
        {{-- @if ($loop->first) --}}
            <li class="post-item tie-standard blog-card"
                style="border: 1px solid #6366F1; box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.1), 0 2px 4px -1px rgba(99, 102, 241, 0.06);padding:4px">
                <a aria-label="{{ $blog->title }}" href="{{ route('blog_detail', $blog->slug) }}" class="post-thumb" style="height: auto !important">
                    <span class="post-cat-wrap">
                        <span class="post-cat tie-cat-405 bgblue-white">
                            {{ $blog->category?->name }}
                        </span>
                    </span>
                    <div class="post-thumb-overlay-wrap">
                        <div class="post-thumb-overlay" style="background-color: rgba(99, 102, 241, 0.9);">
                            <span class="tie-icon tie-media-icon"></span>
                        </div>
                    </div>
                    <div class="aspect-ratio-box">
                        <img src="{{ photo($blog->image, 'blog') }}" loading="lazy"
                             alt="{{ $blog->image_alt_text }}"
                             width="390" height="220"
                             decoding="async"
                             class="attachment-jannah-image-large size-jannah-image-large wp-post-image" />
                    </div>
                </a>
                <div class="post-details-latest">
                    <div class="post-meta clearfix"
                        style="display: flex; align-items: center; gap: 18px; font-size: 0.95rem; color: #6d28d9; margin-bottom: 8px;">
                        <span class="author-meta single-author no-avatars" style="color: #7c3aed; font-weight: 600;">
                            <span class="meta-item meta-author-wrapper meta-author-3">
                                <span class="meta-author">
                                    <span
                                    {{-- href="{{ route('blog_detail', $blog->slug) }}" --}}
                                        class="author-name tie-icon"
                                        title="{{ $author_name = $blog->author?->name }}"
                                        aria-label="{{ $author_name  }}"
                                        style="color: #7c3aed; text-decoration: none;">
                                        {{ $author_name }}
                                    </span>
                                </span>
                            </span>
                        </span>
                        <span class="date meta-item tie-icon" style="font-weight: 500;">
                            {{ $blog->created_at->format('d/m/Y') }}
                        </span>
                        <div class="tie-alignright" style="margin-left: auto;">
                            <span class="meta-views meta-item " style="color: #eab308; font-weight: 600;">
                                <span class="tie-icon-fire" aria-hidden="true"></span>
                                {{ $blog->view_count }}
                            </span>
                        </div>
                    </div>
                    <h2 class="post-title"
                        style="font-size: 1.35rem; font-weight: 700; color: #312e81; margin: 0 0 6px 0;">
                        <a href="{{ route('blog_detail', $blog->slug) }}"
                            aria-label="{{ $blog->title }}"
                            style="color: #312e81; text-decoration: none;">
                            {{ $blog->title }}
                        </a>
                    </h2>
                    <p class="post-excerpt" style="color: #5b21b6; font-size: 1rem; margin-bottom: 8px;">
                        {{ \Illuminate\Support\Str::words(strip_tags($blog->content), 30) }}
                    </p>
                    <a class="more-link button"
                        href="{{ route('blog_detail', $blog->slug) }}"
                        aria-label="Read More"
                        style="display: inline-block; padding: 6px 18px; background: linear-gradient(90deg, #6366f1 0%, #ec4899 100%); color: #fff; border-radius: 8px; font-weight: 700; text-decoration: none; margin-top: 6px; box-shadow: 0 1px 6px 0 rgba(99,102,241,0.10);">
                        Read More &raquo;
                    </a>
                </div>
            </li>
    @endforeach
</ul>

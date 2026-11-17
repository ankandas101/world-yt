
        <ul class="posts-items posts-list-container">

            @foreach ( ($pagination ? $blogs->items() :  $blogs) ?: [] as $blog)
                @if ($loop->first)
                    <!-- .first-post -->
                    <li class="post-item  tie-standard"
                        style="background: linear-gradient(120deg, #e0e7ff 40%, #f3e8ff 100%); border-radius: 16px; box-shadow: 0 2px 16px 0 rgba(99,102,241,0.08); margin-bottom: 18px; overflow: hidden;">
                        <a aria-label=" {{ $blog->title }}" href="{{ route('blog_detail', $blog->slug) }}"
                            class="post-thumb" style="display: block; position: relative;">
                            <span class="post-cat-wrap" style="position: absolute; top: 12px; left: 12px; z-index: 2;">
                                <span class="post-cat tie-cat-399"
                                    style="background: linear-gradient(90deg, #ec4899 0%, #6366f1 100%); color: #fff; font-weight: 600; font-size: 0.8rem; padding: 4px 14px; border-radius: 12px; box-shadow: 0 2px 8px 0 rgba(99,102,241,0.10);">
                                    {{ $blog->category->name }}
                                </span>
                            </span>
                            <div class="post-thumb-overlay-wrap" style="border-radius: 14px; overflow: hidden;">
                                <div class="post-thumb-overlay"
                                    style="background: linear-gradient(180deg, rgba(30,41,59,0.25) 0%, rgba(236,72,153,0.07) 100%); position: absolute; inset: 0; border-radius: 14px;">
                                </div>
                                <span class="tie-icon tie-media-icon"
                                    style="position: absolute; left: 18px; bottom: 14px; color: #fff; font-size: 1.2rem; z-index: 2;"></span>
                            </div>
                            <img width="390" height="220" src="{{ photo($blog->image, 'blog') }}" loading="lazy"
                                class="attachment-jannah-image-large size-jannah-image-large wp-post-image"
                                alt="{{ $blog->image_alt_text }}" decoding="async" fetchpriority="high"
                                style="width: 100%; height: 220px; object-fit: cover; border-radius: 14px; box-shadow: 0 2px 12px 0 rgba(99,102,241,0.10);" />
                        </a>
                        <div class="post-details" style="padding: 18px 14px 10px 14px;">
                            <div class="post-meta clearfix"
                                style="display: flex; align-items: center; gap: 18px; font-size: 0.95rem; color: #6d28d9; margin-bottom: 8px;">
                                <span class="author-meta single-author no-avatars"
                                    style="color: #7c3aed; font-weight: 600;">
                                    <span class="meta-item meta-author-wrapper meta-author-3">
                                        <span class="meta-author">
                                            <span
                                                class="author-name tie-icon" title="{{ $author_name = $blog->author?->name }}"
                                                aria-label="{{ $author_name }}"
                                                style="color: #7c3aed; text-decoration: none;">
                                                {{ $author_name }}
                                            </span>
                                        </span>
                                    </span>
                                </span>
                                <span class="date meta-item tie-icon" style="color: #ec4899; font-weight: 500;">
                                    {{ $blog->created_at->diffForHumans() }}
                                </span>
                                <div class="tie-alignright" style="margin-left: auto;">
                                    <span class="meta-views meta-item " style="color: #eab308; font-weight: 600;">
                                        <span class="tie-icon-fire" aria-hidden="true"></span>
                                        {{ $blog->view_count }}
                                    </span>
                                </div>
                            </div>
                            <!-- .post-meta -->
                            <h2 class="post-title"
                                style="font-size: 1.35rem; font-weight: 700; color: #312e81; margin: 0 0 6px 0;">
                                <a href="{{ route('blog_detail', $blog->slug) }}"
                                    style="color: #312e81; text-decoration: none;"
                                    aria-label="{{ $blog->title }}">
                                    {{ $blog->title }}
                                </a>
                            </h2>

                            <div class="post-excerpt" style="color: #5b21b6; font-size: 1rem; margin-bottom: 8px;">
                                {!! str($blog->content)->words(40) !!}
                            </div>
                            <a class="more-link button" href="{{ route('blog_detail', $blog->slug) }}"
                                style="display: inline-block; padding: 6px 18px; background: linear-gradient(90deg, #6366f1 0%, #ec4899 100%); color: #fff; border-radius: 8px; font-weight: 700; text-decoration: none; margin-top: 6px; box-shadow: 0 1px 6px 0 rgba(99,102,241,0.10);">
                                Read More &raquo;
                            </a>
                        </div>
                    </li>
                @else
                    <li class="post-item  tie-standard"
                        style="background: #fff0fa; border-radius: 12px; box-shadow: 0 1px 8px 0 rgba(236,72,153,0.08); margin-bottom: 14px; overflow: hidden;">
                        <a aria-label="{{ $blog->title }}" href="{{ route('blog_detail', $blog->slug) }}"
                            class="post-thumb">
                            <div class="post-thumb-overlay-wrap" style="border-radius: 10px; overflow: hidden;">
                                <div class="post-thumb-overlay"
                                    style="background: linear-gradient(180deg, rgba(236,72,153,0.10) 0%, rgba(99,102,241,0.05) 100%); position: absolute; inset: 0; border-radius: 10px;">
                                </div>
                                <span class="tie-icon tie-media-icon"
                                    style="position: absolute; left: 12px; bottom: 10px; color: #ec4899; font-size: 1rem; z-index: 2;"></span>
                            </div>
                            <img width="220" height="150" src="{{ photo($blog->image, 'blog') }}" loading="lazy"
                                class="attachment-jannah-image-small size-jannah-image-small tie-small-image wp-post-image"
                                alt="{{ $blog->image_alt_text }}" decoding="async"
                                style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px; box-shadow: 0 1px 6px 0 rgba(236,72,153,0.10);" />
                        </a>
                        <div class="post-details" style="padding: 10px 10px 8px 10px;">
                            <div class="post-meta clearfix"
                                style="font-size: 0.95rem; color: #a21caf; margin-bottom: 5px;">
                                <span class="date meta-item tie-icon" style="color: #a21caf; font-weight: 500;">
                                    {{ $blog->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <h2 class="post-title"
                                style="font-size: 1.08rem; font-weight: 600; color: #a21caf; margin: 0 0 4px 0;">
                                <a href="{{ route('blog_detail', $blog->slug) }}"
                                    aria-label="{{ $blog->title }}"
                                    style="color: #a21caf; text-decoration: none;">
                                    {{ $blog->title }}
                                </a>
                            </h2>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>


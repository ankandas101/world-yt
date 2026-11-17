<ul class="posts-items posts-list-container">
    @foreach ($blogs as $blog)
        <li class="post-item post-9401 post type-post status-publish format-standard has-post-thumbnail category-news tie-standard"
            style="background: linear-gradient(120deg, #f0fdfa 0%, #e0e7ff 60%, #f3e8ff 100%); border-radius: 18px; box-shadow: 0 2px 16px 0 rgba(16,185,129,0.07), 0 1.5px 8px 0 rgba(99,102,241,0.08); margin-bottom: 22px; overflow: hidden; display: flex; flex-direction: column; min-height: 440px; max-height: 440px; height: 440px;">
            <a aria-label="{{ $blog->title }}"
                href="{{ route('blog_detail', $blog->slug) }}"
                class="post-thumb"
                style="display: block; position: relative; flex-shrink: 0; height: 220px; max-height: 220px; overflow: hidden;">
                <span class="post-cat-wrap"
                    style="position: absolute; top: 14px; left: 14px; z-index: 2;">
                    <span class="post-cat tie-cat-2 bgblue-white"
                        style="background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%); color: #fff; font-weight: 600; font-size: 0.85rem; padding: 5px 16px; border-radius: 13px; box-shadow: 0 2px 8px 0 rgba(6,182,212,0.10);">
                        {{ $blog->category?->name }}
                    </span>
                </span>
                <div class="post-thumb-overlay-wrap"
                    style="border-radius: 16px; overflow: hidden;">
                    <div class="post-thumb-overlay"
                        style="background: linear-gradient(180deg, rgba(6,182,212,0.16) 0%, rgba(99,102,241,0.09) 100%); position: absolute; inset: 0; border-radius: 16px;">
                    </div>
                    <span class="tie-icon tie-media-icon"
                        style="position: absolute; left: 20px; bottom: 16px; color: #fff; font-size: 1.2rem; z-index: 2;"></span>
                </div>
                <img width="390" height="220" loading="lazy"
                    src="{{ photo($blog->image, 'blog') }}"
                    class="attachment-jannah-image-large size-jannah-image-large wp-post-image"
                    alt="{{ $blog->image_alt_text }}" decoding="async"
                    style="width: 100%; height: 220px; object-fit: cover; border-radius: 16px; box-shadow: 0 2px 12px 0 rgba(6,182,212,0.10);" />
            </a>
            <div class="post-details"
                style="padding: 20px 16px 12px 16px; display: flex; flex-direction: column; flex: 1 1 auto; min-height: 0;">
                <div class="post-meta clearfix"
                    style="display: flex; align-items: center; gap: 18px; font-size: 1rem; color: #0e7490; margin-bottom: 8px;">
                    <span class="author-meta single-author no-avatars"
                        style="color: #0ea5e9; font-weight: 600;">
                        <span class="meta-item meta-author-wrapper meta-author-3">
                            <span class="meta-author">
                                <span
                                    class="author-name tie-icon"
                                    aria-label="{{ $author_name = $blog->author?->name }}"
                                    title="{{ $author_name }}"
                                    style="color: #0ea5e9; text-decoration: none;">
                                    {{ $author_name }}
                                </span>
                            </span>
                        </span>
                    </span>
                    <span class="date meta-item tie-icon"
                        style="color: #6366f1; font-weight: 500;">
                        {{ $blog->created_at->diffForHumans() }}
                    </span>
                    <div class="tie-alignright" style="margin-left: auto;">
                        <span class="meta-views meta-item "
                            style="color: #f59e42; font-weight: 600;">
                            <span class="tie-icon-fire" aria-hidden="true"></span>
                            {{ $blog->view_count }}
                        </span>
                    </div>
                </div>
                <h2 class="post-title"
                    style="font-size: 1.32rem; font-weight: 700; color: #0f172a; margin: 0 0 6px 0; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; min-height: 2.7em; max-height: 2.7em;">
                    <a href="{{ route('blog_detail', $blog->slug) }}"
                        aria-label="{{ $blog->title }}"
                        style="color: #0f172a; text-decoration: none; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        {{ $blog->title }}
                    </a>
                </h2>
                <p class="post-excerpt"
                    style="color: #334155; font-size: 1.02rem; margin-bottom: 8px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; min-height: 3.9em; max-height: 3.9em; flex: 1 1 auto;">
                    {!! str($blog->content)->words(40) !!}
                </p>
            </div>
            <script>
                // Responsive fix: adjust card height on small screens
                (function() {
                    var card = document.currentScript.parentElement;

                    function resizeCard() {
                        if (window.innerWidth < 700) {
                            card.style.height = 'auto';
                            card.style.minHeight = 'unset';
                            card.style.maxHeight = 'unset';
                        } else {
                            card.style.height = '440px';
                            card.style.minHeight = '440px';
                            card.style.maxHeight = '440px';
                        }
                    }
                    resizeCard();
                    window.addEventListener('resize', resizeCard);
                })
                ();
            </script>
        </li>
    @endforeach
</ul>

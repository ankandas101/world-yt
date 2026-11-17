
<div
    x-data='{
        blogs: @json($recent_blogs->items()),
        page: 1,
        lastPage: "{{$recent_blogs->lastPage()}}",
        loading: false,
        async fetchBlogs(page) {
            this.loading = true;
            const res = await fetch(`/recent-blogs?page=${page}&per_page=5`);
            const data = await res.json();
            this.blogs = data.data;
            this.page = data.current_page;
            this.lastPage = data.last_page;
            this.loading = false;
        }
    }'
    class="widget-posts-list-wrapper"
>
    <div class="widget-posts-list-container">
        <ul class="posts-list-items widget-posts-wrapper"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            x-show="!loading"
        >
            <template x-for="rblog in blogs" :key="rblog.id">
                <li class="widget-single-post-item widget-post-list tie-standard"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                >
                    <template x-if="rblog.image">
                        <div class="post-widget-thumbnail">
                            <a :aria-label="rblog.image_alt_text"
                            :href="`/blog/${rblog.slug}`" class="post-thumb">
                                <img width="220" height="150" loading="lazy"
                                    :src="rblog.image.startsWith('/') ? ('/storage/' + rblog.image) : ('/storage/' + rblog.image)"
                                    class="attachment-jannah-image-small size-jannah-image-small tie-small-image wp-post-image"
                                    :alt="rblog.image_alt_text"
                                    decoding="async" />
                            </a>
                        </div>

                    </template>
                    <div class="post-widget-body ">
                        <a class="post-title the-subtitle"
                            :aria-label="rblog.title"
                            :href="`/blog/${rblog.slug}`"
                            x-text="rblog.title"></a>
                        <div class="post-meta">
                            <span class="date meta-item tie-icon" x-text="rblog.created_at"></span>
                        </div>
                    </div>
                </li>
            </template>
        </ul>
        <div x-show="loading" class="w-full flex justify-center items-center py-6">
            <span class="loader"></span>
        </div>
    </div>
    <div class="widget-pagination-wrapper">
        <ul class="slider-arrow-nav">
            <li>
                <a
                    class="prev_button"
                    href="#"
                    aria-label="Previous page"
                    @click.prevent="if(page > 1) fetchBlogs(page - 1)"
                    :class="{'pagination-disabled': page <= 1, 'blur': page <= 1}"
                    :aria-disabled="page <= 1"
                    :tabindex="page <= 1 ? -1 : 0"

                >
                    <span class="tie-icon-angle-left" aria-hidden="true"></span>
                    <span class="screen-reader-text">Previous page</span>
                </a>
            </li>
            <li>
                <a
                    class="next_button"
                    href="#"
                    aria-label="Next page"
                    @click.prevent="if(page < lastPage) fetchBlogs(page + 1)"
                    :class="{'pagination-disabled': page >= lastPage, 'blur': page >= lastPage}"
                    :aria-disabled="page >= lastPage"
                    :tabindex="page >= lastPage ? -1 : 0"
                >
                    <span class="tie-icon-angle-right" aria-hidden="true"></span>
                    <span class="screen-reader-text">Next page</span>
                </a>
            </li>
        </ul>
    </div>
</div>

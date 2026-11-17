<div class="pages-nav mt-6">
    <div class="pages-numbers pages-standard flex gap-4 justify-between">
        <button
            class="block-pagination prev-posts px-4 py-2 rounded-full font-semibold transition-colors"
            :class="currentPage <= 1 ? 'bg-gray-200 text-gray-400 opacity-60 cursor-not-allowed' : 'bg-gradient-to-r from-blue-400 to-purple-400 text-white hover:from-purple-600 hover:to-blue-500 cursor-pointer'"
            :disabled="currentPage <= 1 || loading"
            @click="goToPrev"
        >
            <span class="pagination-icon" aria-hidden="true"></span>
            Previous
        </button>
        <button
            class="block-pagination next-posts px-4 py-2 rounded-full font-semibold transition-colors"
            :class="!hasNext ? 'bg-gray-200 text-gray-400 opacity-60 cursor-not-allowed' : 'bg-gradient-to-r from-pink-400 to-purple-500 text-white hover:from-purple-500 hover:to-blue-500 cursor-pointer'"
            :disabled="!hasNext || loading"
            @click="goToNext"
        >
            <span class="pagination-icon" aria-hidden="true"></span>
            Next
        </button>
    </div>
</div>

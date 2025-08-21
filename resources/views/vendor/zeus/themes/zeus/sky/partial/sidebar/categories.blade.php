@unless($tags->isEmpty())
    <div class="p-6 bg-white border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700 rounded-2xl">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Categories</h3>
        <div class="space-y-2">
            @foreach($tags as $tag)
                <a href="{{ route('tags',['category',$tag->slug]) }}" 
                   class="flex items-center justify-between p-3 transition-colors bg-gray-50 rounded-xl hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 group">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200 group-hover:text-gray-900 dark:group-hover:text-white">
                        {{ $tag->name }}
                    </span>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-1 text-xs font-medium text-gray-500 bg-white rounded-full dark:bg-gray-800 dark:text-gray-400">
                            {{ $tag->posts_published_count }}
                        </span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform group-hover:translate-x-1 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endunless

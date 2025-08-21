<article class="group" itemscope itemtype="https://schema.org/BlogPosting">
    <div class="overflow-hidden transition-all duration-300 bg-white shadow-sm dark:bg-gray-800 rounded-2xl hover:shadow-lg hover:scale-[1.02] border border-gray-100 dark:border-gray-700">
        <div class="p-8">
            <!-- Header with date and categories -->
            <div class="flex items-center justify-between mb-6">
                <time class="text-sm font-medium text-gray-500 dark:text-gray-400" datetime="{{ optional($post->published_at)->toISOString() }}">
                    {{ optional($post->published_at)->diffForHumans() ?? '' }}
                </time>
                @unless ($post->tags->isEmpty())
                    <div class="flex gap-2">
                        @each($skyTheme.'.partial.category', $post->tags->where('type','category'), 'category')
                    </div>
                @endunless
            </div>

            <!-- Title and description -->
            <div class="mb-6">
                <h2 class="mb-4">
                    <a href="{{ route('post',$post->slug) }}" class="text-2xl font-bold text-gray-900 transition-colors dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 md:text-3xl line-clamp-2">
                        {!! $post->title !!}
                    </a>
                </h2>
                @if($post->description !== null)
                    <p class="text-gray-600 dark:text-gray-300 line-clamp-3 leading-relaxed">
                        {!! $post->description !!}
                    </p>
                @endif
            </div>

            <!-- Footer with author and read more -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}" 
                         alt="{{ $post->author->name ?? 'Author' }}" 
                         class="object-cover w-10 h-10 rounded-full ring-2 ring-gray-100 dark:ring-gray-700">
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $post->author->name ?? 'Anonymous' }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Author</p>
                    </div>
                </div>
                <a href="{{ route('post',$post->slug) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-blue-600 transition-colors bg-blue-50 rounded-full hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:hover:bg-blue-900/30 group">
                    Read more
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</article>

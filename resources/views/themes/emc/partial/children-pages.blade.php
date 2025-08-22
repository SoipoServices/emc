<article class="group">
    <a href="{{ route('page',$post->slug) }}" class="block">
        <div class="overflow-hidden transition-all duration-300 bg-white shadow-sm dark:bg-gray-800 rounded-2xl hover:shadow-lg hover:scale-[1.02] border border-gray-100 dark:border-gray-700">
            @if($post->image('pages') !== null)
                <div class="relative overflow-hidden">
                    <img alt="{{ $post->title }}" 
                         src="{{ $post->image('pages') }}" 
                         class="object-cover w-full h-40 transition-transform duration-300 group-hover:scale-105"/>
                </div>
            @else
                <div class="flex items-center justify-center h-40 bg-gray-100 dark:bg-gray-700">
                    <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            @endif
            
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 transition-colors dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 line-clamp-2">
                    {{ $post->title ?? 'Untitled' }}
                </h3>
                
                @if($post->description)
                    <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm line-clamp-2">
                        {{ $post->description }}
                    </p>
                @endif
                
                <div class="flex items-center gap-2 mt-4 text-sm text-blue-600 dark:text-blue-400 group-hover:gap-3 transition-all">
                    <span>Read more</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
        </div>
    </a>
</article>

@unless($recent->isEmpty())
    <div class="p-6 bg-white border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700 rounded-2xl">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Recent Posts</h3>
        <div class="space-y-4">
            @foreach($recent as $post)
                <a href="{{ route('post',$post->slug) }}" class="block group">
                    <div class="flex gap-3">
                        @if($post->image() !== null)
                            <div class="flex-shrink-0">
                                <img alt="{{ $post->title }}" 
                                     src="{{ $post->image() }}" 
                                     class="object-cover w-12 h-12 rounded-lg"/>
                            </div>
                        @else
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-gray-100 rounded-lg dark:bg-gray-700">
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 transition-colors dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 line-clamp-2">
                                {{ $post->title ?? 'Untitled' }}
                            </h4>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ optional($post->published_at)->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endunless

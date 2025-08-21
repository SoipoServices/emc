@unless($pages->isEmpty())
    <div class="p-6 bg-white border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700 rounded-2xl">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Pages</h3>
        <div class="space-y-2">
            @foreach($pages as $post)
                <a href="{{ route('page',$post->slug) }}" 
                   class="flex items-center gap-3 p-3 transition-colors bg-gray-50 rounded-2xl hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 group">
                    @if($post->image('pages') !== null)
                        <div class="flex-shrink-0">
                            <img alt="{{ $post->title }}" 
                                 src="{{ $post->image('pages') }}" 
                                 class="object-cover w-8 h-8 rounded-2xl"/>
                        </div>
                    @else
                        <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-gray-200 rounded-2xl dark:bg-gray-600">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    @endif
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200 group-hover:text-gray-900 dark:group-hover:text-white">
                        {!! $post->title !!}
                    </span>
                    <svg class="w-4 h-4 ml-auto text-gray-400 transition-transform group-hover:translate-x-1 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @endforeach
        </div>
    </div>
@endunless

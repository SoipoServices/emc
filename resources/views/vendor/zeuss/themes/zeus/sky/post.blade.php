<div class="py-16 bg-gray-50 dark:bg-gray-900">
    <div class="px-6 mx-auto max-w-7xl lg:px-8">
        <x-slot name="header">
            <span class="capitalize">{{ $post->title }}</span>
        </x-slot>

        <x-slot name="breadcrumbs">
            <li class="flex items-center">
                <a href="{{ route('blogs') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200">{{ __('Posts') }}</a>
                @svg('heroicon-s-arrow-small-right','fill-current w-4 h-4 mx-3 rtl:rotate-180 text-gray-400')
            </li>
            <li class="flex items-center text-gray-900 dark:text-white">
                {{ $post->title }}
            </li>
        </x-slot>

        <!-- Article Container -->
        <article class="max-w-4xl mx-auto">
            <!-- Featured Image -->
            @if($post->image() !== null)
                <div class="mb-12">
                    <img alt="{{ $post->title }}" 
                         src="{{ $post->image() }}" 
                         class="w-full aspect-[16/9] object-cover rounded-2xl shadow-lg"/>
                </div>
            @endif

            <!-- Article Content -->
            <div class="overflow-hidden bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <!-- Header -->
                <div class="p-8 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <time class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ optional($post->published_at)->diffForHumans() ?? '' }}
                        </time>
                        @unless ($post->tags->isEmpty())
                            <div class="flex gap-2">
                                @each($skyTheme.'.partial.category', $post->tags->where('type','category'), 'category')
                            </div>
                        @endunless
                    </div>

                    <h1 class="mb-4 text-3xl font-bold text-gray-900 dark:text-white md:text-4xl">
                        {{ $post->title ?? '' }}
                    </h1>
                    
                    @if($post->description)
                        <p class="text-xl leading-relaxed text-gray-600 dark:text-gray-300">
                            {{ $post->description }}
                        </p>
                    @endif

                    <!-- Author Info -->
                    <div class="flex items-center gap-4 mt-8">
                        <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}" 
                             alt="{{ $post->author->name ?? 'Author' }}" 
                             class="object-cover w-12 h-12 rounded-full ring-2 ring-gray-100 dark:ring-gray-700">
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $post->author->name ?? 'Anonymous' }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Author</p>
                        </div>
                    </div>

                    <!-- Tags -->
                    @unless ($post->tags->where('type','tag')->isEmpty())
                        <div class="flex flex-wrap gap-2 mt-6">
                            @foreach($post->tags->where('type','tag') as $tag)
                                @include($skyTheme.'.partial.tag')
                            @endforeach
                        </div>
                    @endunless
                </div>

                <!-- Content -->
                <div class="p-8">
                    <div class="prose prose-lg dark:prose-invert max-w-none">
                        {!! $post->getContent() !!}
                    </div>
                </div>
            </div>

            <!-- Related Posts -->
            @if($related->isNotEmpty())
                <div class="mt-16">
                    <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related Posts</h2>
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($related as $relatedPost)
                            @include($skyTheme.'.partial.related', ['post' => $relatedPost])
                        @endforeach
                    </div>
                </div>
            @endif
        </article>
    </div>
</div>

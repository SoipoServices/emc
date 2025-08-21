<div class="py-16 bg-gray-50 dark:bg-gray-900">
    <div class="px-6 mx-auto max-w-7xl lg:px-8">
        <x-slot name="header">
            <span class="capitalize">{{ $post->title }}</span>
        </x-slot>

        <x-slot name="breadcrumbs">
            @if($post->parent !== null)
                <li class="flex items-center">
                    <a href="{{ route('page',[$post->parent->slug]) }}" 
                       class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 capitalize">{{ $post->parent->title }}</a>
                    @svg('heroicon-s-arrow-small-right','fill-current w-4 h-4 mx-3 text-gray-400')
                </li>
            @endif
            <li class="flex items-center text-gray-900 dark:text-white">
                {{ $post->title }}
            </li>
        </x-slot>

        <!-- Page Container -->
        <article class="mx-auto max-w-4xl">
            <!-- Featured Image -->
            @if($post->image('pages') !== null)
                <div class="mb-12">
                    <img alt="{{ $post->title }}" 
                         src="{{ $post->image('pages') }}" 
                         class="w-full aspect-video object-cover rounded-2xl shadow-lg"/>
                </div>
            @endif

            <!-- Page Content -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
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

                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white md:text-4xl mb-4">
                        {{ $post->title ?? '' }}
                    </h1>
                    
                    @if($post->description)
                        <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed">
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
                </div>

                <!-- Content -->
                <div class="p-8">
                    <div class="prose dark:prose-invert max-w-none prose-lg">
                        {!! $post->getContent() !!}
                    </div>
                </div>
            </div>

            <!-- Child Pages -->
            @if(!$children->isEmpty())
                <div class="mt-16">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Related Pages</h2>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($children as $childPage)
                            @include($skyTheme.'.partial.children-pages', ['post' => $childPage])
                        @endforeach
                    </div>
                </div>
            @endif
        </article>
    </div>
</div>

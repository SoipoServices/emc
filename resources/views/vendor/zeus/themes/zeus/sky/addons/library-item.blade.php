<x-zeus::app :$skyTheme>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Header Section -->
        <section class="w-full py-8 bg-white shadow-sm dark:bg-gray-800 md:py-16">
            <div class="container px-4 mx-auto">
                <div class="flex flex-col items-center justify-center mb-8 space-y-4 text-center">
                    <h1 class="text-2xl font-bold tracking-tighter text-gray-900 sm:text-3xl md:text-4xl lg:text-5xl dark:text-white">
                        {{ $item->title }}
                    </h1>
                    @if($item->description)
                        <p class="max-w-2xl text-sm text-gray-600 dark:text-gray-300 md:text-base lg:text-lg">
                            {{ Str::limit($item->description, 200) }}
                        </p>
                    @endif
                </div>
                
                <!-- Breadcrumb -->
                <nav class="flex justify-center" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('library') }}" class="transition-colors duration-200 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                                {{ __('Libraries') }}
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                @svg('heroicon-s-arrow-small-right','w-4 h-4 text-gray-400 dark:text-gray-500')
                                <span class="ml-1 text-gray-500 dark:text-gray-400 md:ml-2">{{ $item->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </section>

        <!-- Library Item Content -->
        <div class="container px-4 py-8 mx-auto">
            <div class="max-w-4xl mx-auto">
                <!-- Item Info Card -->
                <div class="mb-8 overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-700">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <!-- Type Badge -->
                                @if($item->type === 'IMAGE')
                                    <span class="inline-flex items-center px-3 py-1 mb-4 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200">
                                        @svg('heroicon-o-photo','w-4 h-4 mr-2')
                                        Image
                                    </span>
                                @endif

                                @if($item->type === 'FILE')
                                    <span class="inline-flex items-center px-3 py-1 mb-4 text-sm font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">
                                        @svg('heroicon-o-document','w-4 h-4 mr-2')
                                        Document
                                    </span>
                                @endif

                                @if($item->type === 'VIDEO')
                                    <span class="inline-flex items-center px-3 py-1 mb-4 text-sm font-medium text-purple-800 bg-purple-100 rounded-full dark:bg-purple-900 dark:text-purple-200">
                                        @svg('heroicon-o-film','w-4 h-4 mr-2')
                                        Video
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        @if($item->description)
                            <div class="mb-6 prose prose-gray dark:prose-invert max-w-none">
                                <p class="leading-relaxed text-gray-600 dark:text-gray-300">
                                    {{ $item->description }}
                                </p>
                            </div>
                        @endif

                        <!-- Metadata -->
                        <div class="flex items-center gap-4 pt-4 text-sm text-gray-500 border-t border-gray-100 dark:text-gray-400 dark:border-gray-700">
                            <div class="flex items-center gap-1">
                                @svg('heroicon-o-clock','w-4 h-4')
                                <span>{{ __('Created') }}: {{ $item->created_at->format('M j, Y \a\t g:i A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item Content -->
                <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-700">
                    <div class="p-6">
                        @if($item->file_path !== null)
                            @include($skyTheme.'.addons.library-types.'.strtolower($item->type).'-url')
                        @else
                            <div class="grid grid-cols-1 @if($item->getFiles()->count() > 1) sm:grid-cols-2 lg:grid-cols-3 @endif gap-6">
                                @foreach($item->getFiles() as $file)
                                    <div class="p-6 border border-gray-200 bg-gray-50 dark:bg-gray-600 rounded-xl dark:border-gray-500">
                                        @include($skyTheme.'.addons.library-types.'.strtolower($item->type))
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-zeus::app>

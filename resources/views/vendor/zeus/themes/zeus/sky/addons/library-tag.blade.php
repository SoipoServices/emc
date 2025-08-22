    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Header Section -->
        <section class="w-full py-8 bg-white shadow-sm dark:bg-gray-800 md:py-16">
            <div class="container px-4 mx-auto">
                <div class="flex flex-col items-center justify-center mb-8 space-y-4 text-center">
                    <h1 class="text-2xl font-bold tracking-tighter text-gray-900 sm:text-3xl md:text-4xl lg:text-5xl dark:text-white">
                        {{ $libraryTag->name }}
                    </h1>
                    @if($libraryTag->description)
                        <p class="max-w-2xl text-sm text-gray-600 dark:text-gray-300 md:text-base lg:text-lg">
                            {{ $libraryTag->description }}
                        </p>
                    @else
                        <p class="max-w-2xl text-sm text-gray-600 dark:text-gray-300 md:text-base lg:text-lg">
                            Browse {{ $libraryTag->library->count() }} items in this category.
                        </p>
                    @endif
                </div>
                
                <!-- Breadcrumb -->
                <nav class="flex justify-center" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('library') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors duration-200">
                                {{ __('Libraries') }}
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                @svg('heroicon-s-arrow-small-right','w-4 h-4 text-gray-400 dark:text-gray-500')
                                <span class="ml-1 text-gray-500 dark:text-gray-400 md:ml-2">{{ $libraryTag->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </section>

        <!-- Library Items Content -->
        <div class="container px-4 py-8 mx-auto">
            @if($libraryTag->library->count() > 0)
                <section class="mb-20">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:gap-12">
                        @foreach($libraryTag->library as $lib)
                            <a href="{{ route('library.item', $lib->slug) }}" class="block transition-transform hover:scale-105">
                                <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-700">
                                    <!-- Library Type Badge/Image Area -->
                                    <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-600 dark:to-gray-700">
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            @if($lib->type === 'IMAGE')
                                                <div class="text-center">
                                                    @svg('heroicon-o-photo','w-16 h-16 text-blue-500')
                                                    <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400">Image</div>
                                                </div>
                                            @endif

                                            @if($lib->type === 'FILE')
                                                <div class="text-center">
                                                    @svg('heroicon-o-document','w-16 h-16 text-green-500')
                                                    <div class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">Document</div>
                                                </div>
                                            @endif

                                            @if($lib->type === 'VIDEO')
                                                <div class="text-center">
                                                    @svg('heroicon-o-film','w-16 h-16 text-purple-500')
                                                    <div class="mt-2 text-sm font-medium text-purple-600 dark:text-purple-400">Video</div>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Type Badge -->
                                        <div class="absolute top-4 right-4">
                                            @if($lib->type === 'IMAGE')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    @svg('heroicon-o-photo','w-3 h-3 mr-1')
                                                    Image
                                                </span>
                                            @endif

                                            @if($lib->type === 'FILE')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    @svg('heroicon-o-document','w-3 h-3 mr-1')
                                                    File
                                                </span>
                                            @endif

                                            @if($lib->type === 'VIDEO')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                    @svg('heroicon-o-film','w-3 h-3 mr-1')
                                                    Video
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="p-6">
                                        <h3 class="mb-3 text-xl font-semibold text-gray-800 dark:text-white">
                                            {{ $lib->title ?? '' }}
                                        </h3>
                                        
                                        <!-- Created Date -->
                                        <div class="flex items-center mb-3 text-sm text-gray-600 dark:text-gray-300">
                                            @svg('heroicon-o-clock','w-4 h-4 mr-2 text-gray-500')
                                            <span>{{ $lib->created_at ? $lib->created_at->format('M j, Y') : 'Unknown date' }}</span>
                                        </div>
                                        
                                        <!-- Description -->
                                        @if($lib->description)
                                            <p class="text-gray-700 dark:text-gray-200 line-clamp-3">
                                                {{ Str::limit($lib->description, 150) }}
                                            </p>
                                        @endif
                                        
                                        <!-- View Button -->
                                        <div class="mt-4">
                                            <span class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-300">
                                                View Item
                                                @svg('heroicon-o-arrow-right','w-4 h-4 ml-1')
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @else
                <!-- Empty State -->
                <section class="py-16 text-center">
                    <div class="max-w-md mx-auto">
                        @svg('heroicon-o-folder-open','w-16 h-16 mx-auto mb-4 text-gray-400')
                        <h3 class="mb-4 text-xl font-semibold text-gray-800 dark:text-white">No Items Found</h3>
                        <p class="text-gray-600 dark:text-gray-300">This category doesn't contain any library items yet. Check back soon for new resources!</p>
                    </div>
                </section>
            @endif
        </div>
    </div>

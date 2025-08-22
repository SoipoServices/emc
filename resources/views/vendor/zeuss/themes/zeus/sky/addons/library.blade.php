
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Header Section -->
        <section class="w-full py-8 bg-white shadow-sm dark:bg-gray-800 md:py-16">
            <div class="container px-4 mx-auto">
                <div class="flex flex-col items-center justify-center mb-8 space-y-4 text-center">
                    <h1 class="text-2xl font-bold tracking-tighter text-gray-900 sm:text-3xl md:text-4xl lg:text-5xl dark:text-white">
                        {{ __('Libraries') }}
                    </h1>
                    <p class="max-w-2xl text-sm text-gray-600 dark:text-gray-300 md:text-base lg:text-lg">
                        Explore our collection of resources, documents, images, and videos. Access valuable content organized by categories.
                    </p>
                </div>
            </div>
        </section>

        <!-- Library Content -->
        <div class="container px-4 py-8 mx-auto">
            @forelse($categories as $category)
                <!-- Category Section -->
                <section class="mb-20">
                    <h2 class="mb-12 text-xl font-bold text-gray-900 md:text-2xl dark:text-white">
                        {{ $category->name }}
                        @if($category->description)
                            <span class="block mt-2 text-sm font-normal text-gray-600 dark:text-gray-400">{{ $category->description }}</span>
                        @endif
                    </h2>
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:gap-12">
                        @foreach($category->library as $library)
                            <a href="{{ route('library.item', ['slug' => $library->slug]) }}" class="block transition-transform hover:scale-105">
                                <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-700">
                                    <!-- Library Type Badge/Image Area -->
                                    <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-600 dark:to-gray-700">
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            @if($library->type === 'IMAGE')
                                                <div class="text-center">
                                                    @svg('heroicon-o-photo','w-16 h-16 text-blue-500')
                                                    <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400">Image</div>
                                                </div>
                                            @endif

                                            @if($library->type === 'FILE')
                                                <div class="text-center">
                                                    @svg('heroicon-o-document','w-16 h-16 text-green-500')
                                                    <div class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">Document</div>
                                                </div>
                                            @endif

                                            @if($library->type === 'VIDEO')
                                                <div class="text-center">
                                                    @svg('heroicon-o-film','w-16 h-16 text-purple-500')
                                                    <div class="mt-2 text-sm font-medium text-purple-600 dark:text-purple-400">Video</div>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Type Badge -->
                                        <div class="absolute top-4 right-4">
                                            @if($library->type === 'IMAGE')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    @svg('heroicon-o-photo','w-3 h-3 mr-1')
                                                    Image
                                                </span>
                                            @endif

                                            @if($library->type === 'FILE')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    @svg('heroicon-o-document','w-3 h-3 mr-1')
                                                    File
                                                </span>
                                            @endif

                                            @if($library->type === 'VIDEO')
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
                                            {{ $library->title ?? '' }}
                                        </h3>
                                        
                                        <!-- Created Date -->
                                        <div class="flex items-center mb-3 text-sm text-gray-600 dark:text-gray-300">
                                            @svg('heroicon-o-clock','w-4 h-4 mr-2 text-gray-500')
                                            <span>{{ $library->created_at ? $library->created_at->format('M j, Y') : 'Unknown date' }}</span>
                                        </div>
                                        
                                        <!-- Description -->
                                        @if($library->description)
                                            <p class="text-gray-700 dark:text-gray-200 line-clamp-3">
                                                {{ Str::limit($library->description, 150) }}
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
                    
                    <!-- View All Link for Category -->
                    @if($category->library->count() > 6)
                        <div class="mt-8 text-center">
                            <a href="{{ route('library.tag', $category->slug) }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white border border-transparent rounded-md bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                View All {{ $category->name }} Items
                                @svg('heroicon-o-arrow-right','w-5 h-5 ml-2')
                            </a>
                        </div>
                    @endif
                </section>
            @empty
                <!-- No Categories - Show All Libraries -->
                @php
                    $uncategorizedLibraries = app(config('zeus-sky.models.Library'))->get();
                @endphp
                
                @if($uncategorizedLibraries->count() > 0)
                    <section class="mb-20">
                        <h2 class="mb-12 text-xl font-bold text-gray-900 md:text-2xl dark:text-white">
                            All Library Items
                        </h2>
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:gap-12">
                            @foreach($uncategorizedLibraries as $library)
                                <a href="{{ route('library.item', ['slug' => $library->slug]) }}" class="block transition-transform hover:scale-105">
                                    <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-700">
                                        <!-- Library Type Badge/Image Area -->
                                        <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-600 dark:to-gray-700">
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                @if($library->type === 'IMAGE')
                                                    <div class="text-center">
                                                        @svg('heroicon-o-photo','w-16 h-16 text-blue-500')
                                                        <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400">Image</div>
                                                    </div>
                                                @endif

                                                @if($library->type === 'FILE')
                                                    <div class="text-center">
                                                        @svg('heroicon-o-document','w-16 h-16 text-green-500')
                                                        <div class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">Document</div>
                                                    </div>
                                                @endif

                                                @if($library->type === 'VIDEO')
                                                    <div class="text-center">
                                                        @svg('heroicon-o-film','w-16 h-16 text-purple-500')
                                                        <div class="mt-2 text-sm font-medium text-purple-600 dark:text-purple-400">Video</div>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <!-- Type Badge -->
                                            <div class="absolute top-4 right-4">
                                                @if($library->type === 'IMAGE')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                        @svg('heroicon-o-photo','w-3 h-3 mr-1')
                                                        Image
                                                    </span>
                                                @endif

                                                @if($library->type === 'FILE')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        @svg('heroicon-o-document','w-3 h-3 mr-1')
                                                        File
                                                    </span>
                                                @endif

                                                @if($library->type === 'VIDEO')
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
                                                {{ is_string($library->title) ? $library->title : (json_decode($library->title, true)['en'] ?? $library->title) }}
                                            </h3>
                                            
                                            <!-- Created Date -->
                                            <div class="flex items-center mb-3 text-sm text-gray-600 dark:text-gray-300">
                                                @svg('heroicon-o-clock','w-4 h-4 mr-2 text-gray-500')
                                                <span>{{ $library->created_at ? $library->created_at->format('M j, Y') : 'Unknown date' }}</span>
                                            </div>
                                            
                                            <!-- Description -->
                                            @if($library->description)
                                                <p class="text-gray-700 dark:text-gray-200 line-clamp-3">
                                                    {{ Str::limit(is_string($library->description) ? $library->description : (json_decode($library->description, true)['en'] ?? $library->description), 150) }}
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
                            @svg('heroicon-o-book-open','w-16 h-16 mx-auto mb-4 text-gray-400')
                            <h3 class="mb-4 text-xl font-semibold text-gray-800 dark:text-white">No Library Items</h3>
                            <p class="text-gray-600 dark:text-gray-300">No library items have been created yet. Check back soon for new resources!</p>
                        </div>
                    </section>
                @endif
            @endforelse
        </div>
    </div>


    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Header Section -->
        <section class="w-full py-8 bg-white shadow-sm dark:bg-gray-800 md:py-16">
            <div class="container px-4 mx-auto">
                <div class="flex flex-col items-center justify-center mb-8 space-y-4 text-center">
                    <h1 class="text-2xl font-bold tracking-tighter text-gray-900 sm:text-3xl md:text-4xl lg:text-5xl dark:text-white">
                        Category Posts
                    </h1>
                    <p class="max-w-2xl text-sm text-gray-600 dark:text-gray-300 md:text-base lg:text-lg">
                        @if($posts->count() > 0)
                            Explore {{ $posts->count() }} {{ $posts->count() === 1 ? 'post' : 'posts' }} in this category.
                        @else
                            No posts found in this category.
                        @endif
                    </p>
                </div>
            </div>
        </section>

        <!-- Posts Content -->
        <div class="container px-4 py-8 mx-auto">
            @unless($posts->isEmpty())
                <section class="mb-20">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:gap-12">
                        @foreach($posts as $post)
                            <a href="{{ route($post->post_type, $post->slug) }}" class="block transition-transform hover:scale-105">
                                <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-700">
                                    <!-- Post Image or Placeholder -->
                                    <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-600 dark:to-gray-700">
                                        @if($post->featured_image)
                                            <img src="{{ $post->featured_image }}" alt="{{ is_string($post->title) ? $post->title : (json_decode($post->title, true)['en'] ?? $post->title) }}" class="object-cover w-full h-48">
                                        @else
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-center">
                                                    @if($post->post_type === 'post')
                                                        @svg('heroicon-o-document-text','w-16 h-16 text-blue-500')
                                                        <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400">Blog Post</div>
                                                    @else
                                                        @svg('heroicon-o-document','w-16 h-16 text-green-500')
                                                        <div class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">Page</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <!-- Post Type Badge -->
                                        <div class="absolute top-4 right-4">
                                            @if($post->post_type === 'post')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    @svg('heroicon-o-document-text','w-3 h-3 mr-1')
                                                    Post
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    @svg('heroicon-o-document','w-3 h-3 mr-1')
                                                    Page
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="p-6">
                                        <h3 class="mb-3 text-xl font-semibold text-gray-800 dark:text-white">
                                            {{ is_string($post->title) ? $post->title : (json_decode($post->title, true)['en'] ?? $post->title) }}
                                        </h3>
                                        
                                        <!-- Author and Date -->
                                        <div class="flex items-center mb-3 text-sm text-gray-600 dark:text-gray-300">
                                            @svg('heroicon-o-user','w-4 h-4 mr-2 text-gray-500')
                                            <span class="mr-4">{{ $post->user->name ?? 'Unknown Author' }}</span>
                                            @svg('heroicon-o-clock','w-4 h-4 mr-2 text-gray-500')
                                            <span>{{ $post->published_at ? $post->published_at->format('M j, Y') : ($post->created_at ? $post->created_at->format('M j, Y') : 'Unknown date') }}</span>
                                        </div>
                                        
                                        <!-- Description/Content Preview -->
                                        @php
                                            $content = is_string($post->content) ? $post->content : (json_decode($post->content, true)['en'] ?? $post->content);
                                            $description = is_string($post->description) ? $post->description : (json_decode($post->description, true)['en'] ?? $post->description);
                                        @endphp
                                        
                                        @if($description)
                                            <p class="text-gray-700 dark:text-gray-200 line-clamp-3">
                                                {{ Str::limit(strip_tags($description), 150) }}
                                            </p>
                                        @elseif($content)
                                            <p class="text-gray-700 dark:text-gray-200 line-clamp-3">
                                                {{ Str::limit(strip_tags($content), 150) }}
                                            </p>
                                        @endif
                                        
                                        <!-- Status Badge -->
                                        @if($post->status->value !== 'publish')
                                            <div class="mt-3">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                    {{ ucfirst($post->status->value) }}
                                                </span>
                                            </div>
                                        @endif
                                        
                                        <!-- Read More Button -->
                                        <div class="mt-4">
                                            <span class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-300">
                                                Read More
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
                        <h3 class="mb-4 text-xl font-semibold text-gray-800 dark:text-white">No Posts Found</h3>
                        <p class="text-gray-600 dark:text-gray-300">This category doesn't contain any posts yet. Check back soon for new content!</p>
                    </div>
                </section>
            @endunless
        </div>
    </div>


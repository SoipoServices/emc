<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header Section -->
    <section class="w-full py-8 bg-white shadow-sm dark:bg-gray-800 md:py-16">
            <div class="container px-4 mx-auto">
                <div class="flex flex-col items-center justify-center mb-8 space-y-4 text-center">
                    <h1 class="text-2xl font-bold tracking-tighter text-gray-900 sm:text-3xl md:text-4xl lg:text-5xl dark:text-white">
                        @if($tag)
                            {{ is_string($tag->name) ? $tag->name : (json_decode($tag->name, true)['en'] ?? $tag->name) }}
                        @else
                            {{ ucfirst($type) }}
                        @endif
                    </h1>
                    <p class="max-w-2xl text-sm text-gray-600 dark:text-gray-300 md:text-base lg:text-lg">
                        @if($tag)
                            @if($posts->count() > 0)
                                Explore {{ $posts->count() }} {{ $posts->count() === 1 ? 'post' : 'posts' }} in this {{ $type === 'category' ? 'category' : 'tag' }}.
                            @else
                                No posts found in this {{ $type === 'category' ? 'category' : 'tag' }}.
                            @endif
                        @else
                            Browse all posts by {{ $type === 'category' ? 'category' : 'tag' }}.
                        @endif
                    </p>
                </div>
                
                <!-- Breadcrumb -->
                <nav class="flex justify-center" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('blogs') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors duration-200">
                                {{ __('Blog') }}
                            </a>
                        </li>
                        @if($tag)
                            <li>
                                <div class="flex items-center">
                                    @svg('heroicon-s-arrow-small-right','w-4 h-4 text-gray-400 dark:text-gray-500')
                                    <span class="ml-1 text-gray-500 dark:text-gray-400 md:ml-2">{{ ucfirst($type) }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    @svg('heroicon-s-arrow-small-right','w-4 h-4 text-gray-400 dark:text-gray-500')
                                    <span class="ml-1 text-gray-500 dark:text-gray-400 md:ml-2">{{ is_string($tag->name) ? $tag->name : (json_decode($tag->name, true)['en'] ?? $tag->name) }}</span>
                                </div>
                            </li>
                        @else
                            <li>
                                <div class="flex items-center">
                                    @svg('heroicon-s-arrow-small-right','w-4 h-4 text-gray-400 dark:text-gray-500')
                                    <span class="ml-1 text-gray-500 dark:text-gray-400 md:ml-2">{{ ucfirst($type) }}</span>
                                </div>
                            </li>
                        @endif
                    </ol>
                </nav>
            </div>
        </section>

        <!-- Posts Content -->
        <div class="container px-4 py-8 mx-auto">
            @if($posts->count() > 0)
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

                <!-- Pagination -->
                @if($posts->hasPages())
                    <section class="mb-12">
                        <div class="w-full">
                            <div class="flex justify-center">
                                <div class="w-full pagination-wrapper max-w-none">
                                    {{ $posts->links() }}
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @else
                <!-- Empty State -->
                <section class="py-16 text-center">
                    <div class="max-w-md mx-auto">
                        @if($type === 'category')
                            @svg('heroicon-o-folder-open','w-16 h-16 mx-auto mb-4 text-gray-400')
                        @else
                            @svg('heroicon-o-tag','w-16 h-16 mx-auto mb-4 text-gray-400')
                        @endif
                        <h3 class="mb-4 text-xl font-semibold text-gray-800 dark:text-white">No Posts Found</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            @if($tag)
                                This {{ $type === 'category' ? 'category' : 'tag' }} doesn't contain any posts yet. Check back soon for new content!
                            @else
                                No posts have been tagged with this {{ $type === 'category' ? 'category' : 'tag' }} yet.
                            @endif
                        </p>
                    </div>
                </section>
            @endif
        </div>
    </div>

    <style>
        .pagination-wrapper .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 100%;
        }
        
        .pagination-wrapper .pagination .page-item {
            flex: 1;
            text-align: center;
        }
        
        .pagination-wrapper .pagination .page-link {
            width: 100%;
            display: block;
            padding: 0.75rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .pagination-wrapper .pagination .page-item.active .page-link {
            background-color: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }
        
        .pagination-wrapper .pagination .page-item:not(.active) .page-link {
            background-color: white;
            border: 1px solid #d1d5db;
            color: #374151;
        }
        
        .pagination-wrapper .pagination .page-item:not(.active) .page-link:hover {
            background-color: #f3f4f6;
            border-color: #9ca3af;
        }
        
        .dark .pagination-wrapper .pagination .page-item:not(.active) .page-link {
            background-color: #374151;
            border-color: #4b5563;
            color: #d1d5db;
        }
        
        .dark .pagination-wrapper .pagination .page-item:not(.active) .page-link:hover {
            background-color: #4b5563;
            border-color: #6b7280;
        }
    </style>

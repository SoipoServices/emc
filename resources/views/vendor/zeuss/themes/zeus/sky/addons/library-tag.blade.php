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
                            <a href="{{ route('library') }}" class="transition-colors duration-200 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
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
                            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-700 group relative">
                                <!-- Heart Button -->
                                @auth
                                    @php
                                        $isSaved = auth()->user()->savedLibraryItems()->where('library_id', $lib->id)->exists();
                                    @endphp
                                    <button onclick="toggleLibraryItem({{ $lib->id }}, this)" 
                                            class="absolute top-3 right-3 z-10 flex items-center justify-center w-8 h-8 transition-all bg-white rounded-full shadow-md hover:scale-110 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800"
                                            data-library-id="{{ $lib->id }}"
                                            data-saved="{{ $isSaved ? 'true' : 'false' }}">
                                        <x-heroicon-s-heart class="w-5 h-5 {{ $isSaved ? 'text-red-500' : 'text-gray-400 hover:text-red-500' }}" />
                                    </button>
                                @endauth

                                <a href="{{ route('library.item', $lib->slug) }}" class="block transition-transform group-hover:scale-105">
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
                                </a>
                            </div>
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

    @auth
    @push('scripts')
    <script>
        function toggleLibraryItem(libraryId, button) {
            const heartIcon = button.querySelector('svg');
            const isSaved = button.dataset.saved === 'true';
            
            // Disable button during request
            button.disabled = true;

            const url = isSaved ? '{{ route("private.library.destroy") }}' : '{{ route("private.library.store") }}';
            const method = isSaved ? 'DELETE' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    library_id: libraryId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update button state
                    const newSavedState = !isSaved;
                    button.dataset.saved = newSavedState.toString();
                    
                    // Update heart icon appearance
                    if (newSavedState) {
                        heartIcon.className = 'w-5 h-5 text-red-500';
                    } else {
                        heartIcon.className = 'w-5 h-5 text-gray-400 hover:text-red-500';
                    }
                    
                    // Show success message
                    showNotification(data.message, 'success');
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred. Please try again.', 'error');
            })
            .finally(() => {
                button.disabled = false;
            });
        }

        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;
            
            // Add to page
            document.body.appendChild(notification);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    </script>
    @endpush
    @endauth

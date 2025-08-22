<x-zeus::private-app title="{{ __('My Library') }}">
<div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">

    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
        
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('My Library') }}</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Your saved library items') }} ({{ $savedLibraryItems->count() }} {{ Str::plural('item', $savedLibraryItems->count()) }})
                    </p>
                </div>
            </div>
            
            <!-- Back to Libraries Link -->
            <a href="{{ route('library') }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 transition-colors rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800">
                <x-heroicon-o-arrow-left class="w-4 h-4 mr-2" />
                {{ __('Browse Library') }}
            </a>
        </div>
    </div>

    <!-- Library Items Grid -->
    @if($savedLibraryItems->count() > 0)
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($savedLibraryItems as $library)
                <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800 group">
                    <!-- Library Type Badge/Image Area -->
                    <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-600 dark:to-gray-700">
                        <a href="{{ route('library.item', $library->slug) }}" class="block h-full">
                            <div class="absolute inset-0 flex items-center justify-center transition-transform group-hover:scale-105">
                                @if($library->type === 'IMAGE')
                                    <div class="text-center">
                                        <x-heroicon-o-photo class="w-16 h-16 text-blue-500" />
                                        <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400">Image</div>
                                    </div>
                                @endif

                                @if($library->type === 'FILE')
                                    <div class="text-center">
                                        <x-heroicon-o-document class="w-16 h-16 text-green-500" />
                                        <div class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">Document</div>
                                    </div>
                                @endif

                                @if($library->type === 'VIDEO')
                                    <div class="text-center">
                                        <x-heroicon-o-film class="w-16 h-16 text-purple-500" />
                                        <div class="mt-2 text-sm font-medium text-purple-600 dark:text-purple-400">Video</div>
                                    </div>
                                @endif
                            </div>
                        </a>
                        
                        <!-- Remove Button -->
                        <div class="absolute top-3 right-3">
                            <button onclick="removeFromLibrary({{ $library->id }})" 
                                    class="flex items-center justify-center w-8 h-8 text-red-600 transition-all bg-white rounded-full shadow-md hover:bg-red-50 hover:text-red-700 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-red-900 dark:hover:text-red-300">
                                <x-heroicon-s-trash class="w-4 h-4" />
                            </button>
                        </div>

                        <!-- Type Badge -->
                        <div class="absolute bottom-3 left-3">
                            @if($library->type === 'IMAGE')
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200">
                                    <x-heroicon-o-photo class="w-3 h-3 mr-1" />
                                    Image
                                </span>
                            @endif

                            @if($library->type === 'FILE')
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">
                                    <x-heroicon-o-document class="w-3 h-3 mr-1" />
                                    File
                                </span>
                            @endif

                            @if($library->type === 'VIDEO')
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded-full dark:bg-purple-900 dark:text-purple-200">
                                    <x-heroicon-o-film class="w-3 h-3 mr-1" />
                                    Video
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="mb-2 text-lg font-semibold text-gray-800 dark:text-white line-clamp-2">
                            <a href="{{ route('library.item', $library->slug) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                                {{ $library->title ?? '' }}
                            </a>
                        </h3>
                        
                        <!-- Description -->
                        @if($library->description)
                            <p class="mb-3 text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                                {{ Str::limit($library->description, 100) }}
                            </p>
                        @endif
                        
                        <!-- Saved Date -->
                        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <x-heroicon-o-calendar class="w-3 h-3 mr-1" />
                                <span>{{ __('Saved') }}: {{ $library->pivot->created_at->format('M j, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="py-16 text-center">
            <div class="max-w-md mx-auto">
                <x-heroicon-o-heart class="w-16 h-16 mx-auto mb-4 text-gray-400" />
                <h3 class="mb-4 text-xl font-semibold text-gray-800 dark:text-white">{{ __('No Saved Items') }}</h3>
                <p class="mb-6 text-gray-600 dark:text-gray-300">
                    {{ __('You haven\'t saved any library items yet. Browse our library to start building your collection!') }}
                </p>
                <a href="{{ route('library') }}" 
                   class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition-colors bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <x-heroicon-o-book-open class="w-5 h-5 mr-2" />
                    {{ __('Browse Library') }}
                </a>
            </div>
        </div>
    @endif

    @push('scripts')
    <script>
        function removeFromLibrary(libraryId) {
            if (!confirm('Are you sure you want to remove this item from your library?')) {
                return;
            }

            fetch('{{ route("private.library.destroy") }}', {
                method: 'DELETE',
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
                    // Show success message
                    showNotification(data.message, 'success');
                    // Reload the page to reflect changes
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred while removing the item.', 'error');
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
</div>
</x-zeus::private-app>

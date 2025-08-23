<x-theme::private-app title="{{ __('My Library') }}">
    <!-- Twitter-like Feed Header -->
    <div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">My Library</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $savedLibraryItems->total() }} {{ Str::plural('item', $savedLibraryItems->total()) }}</p>
            </div>
            <div class="flex items-center gap-4">
                <!-- Search Form -->
                <form method="GET" action="{{ route('private.library.index', ['user' => auth()->id()]) }}" class="flex">
                    <div class="relative">
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search library items..." class="w-64 py-2 pl-4 pr-4 text-sm text-gray-900 bg-gray-100 border-0 rounded-full dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-800 dark:text-white">
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-2">
                            <svg class="w-5 h-5 text-gray-400 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 mx-4 mt-4 text-green-700 bg-green-100 border border-green-400 rounded-2xl dark:bg-green-900 dark:border-green-600 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Results Info -->
    @if(isset($search) && $search)
        <div class="flex items-center gap-3 p-4 mx-4 mt-4 border border-blue-200 bg-blue-50 rounded-2xl dark:bg-blue-900/20 dark:border-blue-800 ">
            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span class="text-blue-900 dark:text-blue-300">Showing search results for:</span>
            <span class="px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/50 dark:text-blue-300">{{ $search }}</span>
            <a href="{{ route('private.library.index', ['user' => auth()->id()]) }}" class="ml-auto text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Clear search</a>
        </div>
    @endif

    <!-- Library Items Feed -->
    <div class="divide-y divide-gray-200 dark:divide-gray-800">
        @forelse ($savedLibraryItems as $library)
            <div class="p-4 transition-colors hover:bg-gray-50 dark:hover:bg-gray-950">
                <div class="flex items-start gap-3">
                    <!-- Library Type Icon -->
                    <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full dark:bg-gray-800">
                        @if($library->type === 'IMAGE')
                            <x-heroicon-o-photo class="w-6 h-6 text-blue-500" />
                        @elseif($library->type === 'FILE')
                            <x-heroicon-o-document class="w-6 h-6 text-green-500" />
                        @elseif($library->type === 'VIDEO')
                            <x-heroicon-o-film class="w-6 h-6 text-purple-500" />
                        @else
                            <x-heroicon-o-book-open class="w-6 h-6 text-gray-500" />
                        @endif
                    </div>
                    
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <h3 class="font-bold text-gray-900 truncate dark:text-white">
                                <a href="{{ route('library.item', $library->slug) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                                    {{ $library->title ?? 'Untitled' }}
                                </a>
                            </h3>
                            
                            <!-- Type Badge -->
                            @if($library->type === 'IMAGE')
                                <span class="px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                                    Image
                                </span>
                            @elseif($library->type === 'FILE')
                                <span class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">
                                    File
                                </span>
                            @elseif($library->type === 'VIDEO')
                                <span class="px-2 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded-full dark:bg-purple-900/30 dark:text-purple-300">
                                    Video
                                </span>
                            @endif
                        </div>
                        
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Saved</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">·</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $library->pivot->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <!-- Library Description -->
                        @if($library->description)
                            <div class="mt-2">
                                <p class="text-sm text-gray-900 dark:text-white">{!! Str::limit(strip_tags($library->description), 200) !!}</p>
                            </div>
                        @endif
                        
                        <!-- Library Actions -->
                        <div class="flex items-center gap-4 mt-3">
                            <a href="{{ route('library.item', $library->slug) }}" 
                               class="inline-flex items-center gap-1 text-sm text-gray-500 transition-colors hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400">
                                <x-heroicon-o-eye class="w-4 h-4" />
                                View
                            </a>
                            
                            <button onclick="removeFromLibrary({{ $library->id }})" 
                                    class="inline-flex items-center gap-1 text-sm text-gray-500 transition-colors hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400">
                                <x-heroicon-o-trash class="w-4 h-4" />
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-16 text-center">
                <x-heroicon-o-heart class="w-16 h-16 mx-auto mb-4 text-gray-400" />
                <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">No library items found</h3>
                <p class="text-gray-500 dark:text-gray-400">
                    {{ isset($search) && $search ? 'Try adjusting your search to find what you\'re looking for.' : 'You haven\'t saved any library items yet. Browse our library to start building your collection!' }}
                </p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($savedLibraryItems->hasPages())
        <div class="flex items-center justify-center p-4 border-t border-gray-200 md:justify-between dark:border-gray-800">
            {{ $savedLibraryItems->links() }}
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

</x-theme::private-app>

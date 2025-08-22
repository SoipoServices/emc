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

                            <!-- Save/Unsave Button -->
                            @auth
                                @php
                                    $isSaved = auth()->user()->savedLibraryItems()->where('library_id', $item->id)->exists();
                                @endphp
                                <div class="ml-4">
                                    <button id="save-button" 
                                            onclick="toggleLibraryItem({{ $item->id }})" 
                                            class="flex items-center px-4 py-2 text-sm font-medium transition-colors border rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $isSaved ? 'bg-red-50 text-red-700 border-red-200 hover:bg-red-100 focus:ring-red-500 dark:bg-red-900 dark:text-red-300 dark:border-red-700 dark:hover:bg-red-800' : 'bg-blue-50 text-blue-700 border-blue-200 hover:bg-blue-100 focus:ring-blue-500 dark:bg-blue-900 dark:text-blue-300 dark:border-blue-700 dark:hover:bg-blue-800' }}">
                                        <x-heroicon-s-heart id="heart-icon" class="w-4 h-4 mr-2 {{ $isSaved ? 'text-red-600 dark:text-red-400' : 'text-blue-600 dark:text-blue-400' }}" />
                                        <span id="button-text">{{ $isSaved ? __('Remove from Library') : __('Save to Library') }}</span>
                                    </button>
                                </div>
                            @endauth
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

    @auth
    @push('scripts')
    <script>
        let isSaved = {{ auth()->user()->savedLibraryItems()->where('library_id', $item->id)->exists() ? 'true' : 'false' }};

        function toggleLibraryItem(libraryId) {
            const button = document.getElementById('save-button');
            const buttonText = document.getElementById('button-text');
            const heartIcon = document.getElementById('heart-icon');
            
            // Disable button during request
            button.disabled = true;
            buttonText.textContent = 'Processing...';

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
                    // Toggle state
                    isSaved = !isSaved;
                    
                    // Update button appearance
                    updateButtonAppearance();
                    
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

        function updateButtonAppearance() {
            const button = document.getElementById('save-button');
            const buttonText = document.getElementById('button-text');
            const heartIcon = document.getElementById('heart-icon');

            if (isSaved) {
                // Saved state - red styling
                button.className = 'flex items-center px-4 py-2 text-sm font-medium transition-colors border rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 bg-red-50 text-red-700 border-red-200 hover:bg-red-100 focus:ring-red-500 dark:bg-red-900 dark:text-red-300 dark:border-red-700 dark:hover:bg-red-800';
                heartIcon.className = 'w-4 h-4 mr-2 text-red-600 dark:text-red-400';
                buttonText.textContent = 'Remove from Library';
            } else {
                // Unsaved state - blue styling
                button.className = 'flex items-center px-4 py-2 text-sm font-medium transition-colors border rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 bg-blue-50 text-blue-700 border-blue-200 hover:bg-blue-100 focus:ring-blue-500 dark:bg-blue-900 dark:text-blue-300 dark:border-blue-700 dark:hover:bg-blue-800';
                heartIcon.className = 'w-4 h-4 mr-2 text-blue-600 dark:text-blue-400';
                buttonText.textContent = 'Save to Library';
            }
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

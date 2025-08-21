<x-zeus::private-app :$skyTheme>
<div>
    <!-- Header -->
    <div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">My Businesses</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage your business listings</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('private.businesses.create', auth()->user()) }}" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-full hover:bg-blue-700">
                    Add Business
                </a>
            </div>
        </div>
    </div>

    <!-- Business List -->
    <div class="p-6">
        @if(session('success'))
            <div class="p-4 mb-6 text-green-700 bg-green-100 border border-green-400 rounded-2xl dark:bg-green-900 dark:border-green-600 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if($businesses->count() > 0)
            <div class="space-y-6">
                @foreach($businesses as $business)
                    <div class="overflow-hidden bg-white border border-gray-200 shadow-lg dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                        @if($business->is_sponsor)
                            <!-- Sponsor Badge -->
                            <div class="px-4 py-2 text-center text-white bg-gradient-to-r from-yellow-400 to-yellow-600">
                                <div class="flex items-center justify-center space-x-2">
                                    <span>⭐</span>
                                    <span class="text-sm font-bold">SPONSOR STATUS</span>
                                    <span>⭐</span>
                                </div>
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex items-start space-x-4">
                                @if($business->photo_path)
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/' . $business->photo_path) }}" 
                                             alt="{{ $business->name }}" 
                                             class="object-contain w-16 h-16 p-2 rounded-lg bg-gray-50 dark:bg-gray-700">
                                    </div>
                                @else
                                    <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-gray-100 rounded-lg dark:bg-gray-700">
                                        <span class="text-lg font-bold text-gray-400 dark:text-gray-500">
                                            {{ substr($business->name, 0, 2) }}
                                        </span>
                                    </div>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $business->name }}
                                            </h3>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                {!! Str::limit(strip_tags($business->description), 150) !!}
                                            </p>
                                            
                                            <div class="flex items-center mt-3 space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                                @if($business->email)
                                                    <span class="flex items-center space-x-1">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                                        </svg>
                                                        <span>{{ $business->email }}</span>
                                                    </span>
                                                @endif
                                                
                                                @if($business->url)
                                                    <span class="flex items-center space-x-1">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.559-.499-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.559.499.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.497-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.148.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span>{{ parse_url($business->website, PHP_URL_HOST) }}</span>
                                                    </span>
                                                @endif

                                                <span class="flex items-center space-x-1">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span>Created {{ $business->created_at->diffForHumans() }}</span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex items-center ml-4 space-x-2">
                                            <!-- View Button -->
                                            <a href="{{ route('public.business.show', $business->slug) }}" 
                                               class="px-3 py-1.5 text-xs font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
                                                View
                                            </a>
                                            
                                            <!-- Edit Button -->
                                            <a href="{{ route('private.businesses.edit', ['user' => $business->user_id, 'business' => $business->id]) }}" 
                                               class="px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800 transition-colors">
                                                Edit
                                            </a>
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('private.businesses.destroy', ['user' => $business->user_id, 'business' => $business->id]) }}" method="POST" class="inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this business?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 rounded-lg hover:bg-red-200 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800 transition-colors">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($businesses->hasPages())
                <div class="mt-8">
                    {{ $businesses->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="py-12 text-center">
                <div class="flex items-center justify-center w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full dark:bg-gray-800">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">No businesses yet</h3>
                <p class="mb-6 text-gray-500 dark:text-gray-400">Get started by creating your first business listing.</p>
                <a href="{{ route('private.businesses.create', auth()->user()) }}" 
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Your First Business
                </a>
            </div>
        @endif
    </div>
</div>
</x-zeus::private-app>

<x-zeus::private-app :$skyTheme>
<div>
    <!-- Header -->
    <div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ $business->name }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Business Details</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('private.businesses.edit', $business) }}" class="px-4 py-2 text-sm font-medium text-blue-700 bg-blue-100 rounded-full hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800 transition-colors">
                    Edit Business
                </a>
                <a href="{{ route('private.businesses.list') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-full hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition-colors">
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Business Details -->
    <div class="p-6">
        <div class="max-w-4xl">
            <!-- Business Header Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden mb-6">
                @if($business->is_sponsor)
                    <!-- Sponsor Badge -->
                    <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white px-6 py-3 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <span class="text-lg">⭐</span>
                            <span class="font-bold">SPONSOR STATUS ACTIVE</span>
                            <span class="text-lg">⭐</span>
                        </div>
                    </div>
                @endif

                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6">
                        @if($business->logo_path)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $business->logo_path) }}" 
                                     alt="{{ $business->name }}" 
                                     class="w-20 h-20 md:w-24 md:h-24 object-contain rounded-2xl bg-gray-50 dark:bg-gray-700 p-3">
                            </div>
                        @else
                            <div class="flex-shrink-0 w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-2xl flex items-center justify-center">
                                <span class="text-xl md:text-2xl font-bold text-gray-400 dark:text-gray-500">
                                    {{ substr($business->name, 0, 2) }}
                                </span>
                            </div>
                        @endif

                        <div class="flex-1">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ $business->name }}
                            </h2>
                            
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                                <span class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Created {{ $business->created_at->format('M d, Y') }}</span>
                                </span>
                                
                                <span class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Updated {{ $business->updated_at->diffForHumans() }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Business Description</h3>
                <div class="prose prose-lg max-w-none dark:prose-invert">
                    {!! $business->description !!}
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Contact Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white">Email</h4>
                            @if($business->contact_email)
                                <a href="mailto:{{ $business->contact_email }}" 
                                   class="text-green-600 dark:text-green-400 hover:underline">
                                    {{ $business->contact_email }}
                                </a>
                            @else
                                <span class="text-gray-500 dark:text-gray-400">Not provided</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.559-.499-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.559.499.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.497-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.148.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white">Website</h4>
                            @if($business->website)
                                <a href="{{ $business->website }}" target="_blank" 
                                   class="text-blue-600 dark:text-blue-400 hover:underline">
                                    {{ parse_url($business->website, PHP_URL_HOST) }}
                                </a>
                            @else
                                <span class="text-gray-500 dark:text-gray-400">Not provided</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('private.businesses.edit', $business) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Business
                    </a>
                    
                    <a href="{{ route('public.business.show', $business->slug) }}" target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View Public Page
                    </a>
                    
                    <form action="{{ route('private.businesses.destroy', $business) }}" method="POST" class="inline" 
                          onsubmit="return confirm('Are you sure you want to delete this business? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Business
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-zeus::private-app>

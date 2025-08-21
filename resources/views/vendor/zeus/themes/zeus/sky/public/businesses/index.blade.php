<x-zeus::app :$skyTheme>
    <x-slot name="title">Business Directory</x-slot>

    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="mb-4 text-4xl font-bold text-gray-900 dark:text-white">Business Directory</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">Discover local businesses in our community</p>
        </div>

        <!-- Search and Filter -->
        <div class="mb-8">
            <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                <div class="flex-1 max-w-md">
                    <form method="GET" action="{{ route('public.businesses.index') }}">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Search businesses..." 
                                   class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $businesses->total() }} businesses found
                </div>
            </div>
        </div>

        <!-- Sponsors Section -->
        @if($sponsors->count() > 0)
        <div class="mb-12">
            <div class="flex items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Our Sponsors</h2>
                <div class="px-3 py-1 ml-3 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-200">
                    FEATURED
                </div>
            </div>
            
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($sponsors as $sponsor)
                <div class="relative group">
                    <!-- Sponsor Badge -->
                    <div class="absolute z-10 -top-2 -right-2">
                        <div class="px-3 py-1 text-xs font-bold text-white rounded-full shadow-lg bg-gradient-to-r from-yellow-400 to-yellow-600">
                            ⭐ SPONSOR
                        </div>
                    </div>
                    
                    <!-- Business Card -->
                    <div class="overflow-hidden transition-all duration-300 transform bg-white border-2 border-yellow-200 shadow-xl dark:bg-gray-800 rounded-2xl dark:border-yellow-600 group-hover:scale-105">
                        @if($sponsor->logo_path)
                            <div class="flex items-center justify-center h-48 p-6 bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900 dark:to-yellow-800">
                                <img src="{{ asset('storage/' . $sponsor->logo_path) }}" 
                                     alt="{{ $sponsor->name }}" 
                                     class="object-contain max-w-full max-h-32">
                            </div>
                        @else
                            <div class="flex items-center justify-center h-48 bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900 dark:to-yellow-800">
                                <div class="text-4xl font-bold text-yellow-600 dark:text-yellow-400">
                                    {{ substr($sponsor->name, 0, 2) }}
                                </div>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">{{ $sponsor->name }}</h3>
                            <p class="mb-4 text-gray-600 dark:text-gray-400 line-clamp-3">
                                {!! Str::limit(strip_tags($sponsor->description), 120) !!}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-2">
                                    @if($sponsor->website)
                                        <a href="{{ $sponsor->website }}" target="_blank" 
                                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.559-.499-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.559.499.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.497-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.148.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    @endif
                                    @if($sponsor->contact_email)
                                        <a href="mailto:{{ $sponsor->contact_email }}" 
                                           class="text-green-600 hover:text-green-800 dark:text-green-400">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                                <a href="{{ route('public.business.show', $sponsor->slug) }}" 
                                   class="px-4 py-2 text-sm font-medium text-white transition-all duration-200 rounded-lg bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Regular Businesses Section -->
        <div>
            <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">All Businesses</h2>
            
            @if($businesses->count() > 0)
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($businesses as $business)
                    <div class="overflow-hidden transition-all duration-300 bg-white shadow-lg dark:bg-gray-800 rounded-2xl group hover:shadow-xl">
                        @if($business->logo_path)
                            <div class="flex items-center justify-center h-48 p-6 bg-gray-50 dark:bg-gray-700">
                                <img src="{{ asset('storage/' . $business->logo_path) }}" 
                                     alt="{{ $business->name }}" 
                                     class="object-contain max-w-full max-h-32">
                            </div>
                        @else
                            <div class="flex items-center justify-center h-48 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                                <div class="text-3xl font-bold text-gray-400 dark:text-gray-500">
                                    {{ substr($business->name, 0, 2) }}
                                </div>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">{{ $business->name }}</h3>
                            <p class="mb-4 text-gray-600 dark:text-gray-400 line-clamp-3">
                                {!! Str::limit(strip_tags($business->description), 120) !!}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-2">
                                    @if($business->website)
                                        <a href="{{ $business->website }}" target="_blank" 
                                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.559-.499-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.559.499.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.497-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.148.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    @endif
                                    @if($business->contact_email)
                                        <a href="mailto:{{ $business->contact_email }}" 
                                           class="text-green-600 hover:text-green-800 dark:text-green-400">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                                <a href="{{ route('public.business.show', $business->slug) }}" 
                                   class="px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $businesses->appends(request()->query())->links() }}
                </div>
            @else
                <div class="py-12 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No businesses found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No businesses match your search criteria.</p>
                </div>
            @endif
        </div>
    </div>
</x-zeus::layout>

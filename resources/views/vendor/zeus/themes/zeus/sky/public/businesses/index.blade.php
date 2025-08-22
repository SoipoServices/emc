@use('Illuminate\Support\Facades\Storage')

<x-zeus::app :$skyTheme>
    <x-slot name="title">Business Directory</x-slot>

    <div class="max-w-6xl mx-auto my-20">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="mb-4 text-4xl font-bold text-gray-900 dark:text-white">Business Directory</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">Discover local businesses in our community</p>
        </div>

        {{-- <!-- Search and Filter -->
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
        </div> --}}

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
                        <div class="px-3 py-1 text-xs font-bold text-white bg-orange-500 rounded-full shadow-lg dark:bg-yellow-500">
                            ⭐ SPONSOR
                        </div>
                    </div>
                    
                    <!-- Business Card -->
                    <div class="overflow-hidden transition-all duration-300 transform bg-white border-2 border-yellow-200 shadow-xl dark:bg-gray-800 rounded-2xl dark:border-yellow-600 group-hover:scale-105">
                        @if($sponsor->photo_path)
                            <div class="flex items-center justify-center h-48 p-6 bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900 dark:to-yellow-800">
                                <img src="{{ Storage::disk('public')->url($sponsor->photo_path) }}" 
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
                                    @if($sponsor->url)
                                        <a href="{{ $sponsor->url }}" target="_blank" 
                                           class="text-gray-600 transition-colors hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                            <x-heroicon-o-globe-europe-africa class="w-6 h-6" />
                                        </a>
                                    @endif
                                    @if($sponsor->email)
                                        <a href="mailto:{{ $sponsor->email }}" 
                                           class="text-gray-600 transition-colors hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                            <x-heroicon-o-envelope class="w-6 h-6" />
                                        </a>
                                    @endif
                                    @if($sponsor->telephone)
                                        <a href="tel:{{ $sponsor->telephone }}" 
                                           class="text-gray-600 transition-colors hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                            <x-heroicon-s-phone class="w-6 h-6" />
                                        </a>
                                    @endif
                                    @if($sponsor->linkedin_url)
                                        <a href="{{ $sponsor->linkedin_url }}" target="_blank" 
                                           class="text-gray-600 transition-colors hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                            <x-fab-linkedin class="w-6 h-6" />
                                        </a>
                                    @endif
                                </div>
                                <a href="{{ route('public.business.show', $sponsor->slug) }}" 
                                   class="px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
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
                        @if($business->photo_path)
                            <div class="flex items-center justify-center h-48 p-6 bg-gray-50 dark:bg-gray-700">
                                <img src="{{ Storage::disk('public')->url($business->photo_path) }}" 
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
                                <div>
                                    <!-- No social icons for regular businesses -->
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
                    <x-heroicon-o-building-office class="w-12 h-12 mx-auto text-gray-400" />
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No businesses found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No businesses match your search criteria.</p>
                </div>
            @endif
        </div>
    </div>
</x-zeus::layout>

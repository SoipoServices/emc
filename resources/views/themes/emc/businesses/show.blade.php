@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-zeus::app :$skyTheme>
    <x-slot name="title">{{ $business->name }}</x-slot>

    <div class="max-w-4xl mx-auto my-20">
        <!-- Business Header -->
        <div class="mb-8 overflow-hidden bg-white shadow-lg dark:bg-gray-800 rounded-2xl">
            @if($business->is_sponsor)
                <!-- Sponsor Badge -->
                <div class="px-6 py-2 text-center text-white bg-orange-500 dark:bg-yellow-500">
                    <div class="flex items-center justify-center space-x-2">
                        <span class="text-lg">⭐</span>
                        <span class="font-bold">COMMUNITY SPONSOR</span>
                        <span class="text-lg">⭐</span>
                    </div>
                </div>
            @endif

            <div class="p-8">
                <div class="flex flex-col items-start space-y-4 md:flex-row md:items-center md:space-y-0 md:space-x-6">
                    @if($business->photo_path)
                        <div class="flex-shrink-0">
                            <img src="{{ Storage::disk('public')->url($business->photo_path) }}" 
                                 alt="{{ $business->name }}" 
                                 class="object-contain w-24 h-24 p-4 md:w-32 md:h-32 rounded-2xl bg-gray-50 dark:bg-gray-700">
                        </div>
                    @else
                        <div class="flex items-center justify-center flex-shrink-0 w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-2xl">
                            <span class="text-2xl font-bold text-gray-400 md:text-3xl dark:text-gray-500">
                                {{ substr($business->name, 0, 2) }}
                            </span>
                        </div>
                    @endif

                    <div class="flex-1">
                        <h1 class="mb-2 text-3xl font-bold text-gray-900 md:text-4xl dark:text-white">
                            {{ $business->name }}
                        </h1>
                        
                        <div class="flex flex-wrap items-center space-x-4 text-gray-600 dark:text-gray-400">
                            @if($business->is_sponsor)
                                <!-- Sponsor Contact Icons -->
                                @if($business->url)
                                    <a href="{{ $business->url }}" target="_blank" 
                                       class="flex items-center space-x-1 text-gray-600 transition-colors hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                        <x-heroicon-o-globe-europe-africa class="w-5 h-5" />
                                        <span>Website</span>
                                    </a>
                                @endif
                                
                                @if($business->email)
                                    <a href="mailto:{{ $business->email }}" 
                                       class="flex items-center space-x-1 text-gray-600 transition-colors hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                        <x-heroicon-o-envelope class="w-5 h-5" />
                                        <span>{{ $business->email }}</span>
                                    </a>
                                @endif
                                
                                @if($business->telephone)
                                    <a href="tel:{{ $business->telephone }}" 
                                       class="flex items-center space-x-1 text-gray-600 transition-colors hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                        <x-heroicon-s-phone class="w-5 h-5" />
                                        <span>{{ $business->telephone }}</span>
                                    </a>
                                @endif
                                
                                @if($business->linkedin_url)
                                    <a href="{{ $business->linkedin_url }}" target="_blank" 
                                       class="flex items-center space-x-1 text-gray-600 transition-colors hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                        <x-fab-linkedin class="w-5 h-5" />
                                        <span>LinkedIn</span>
                                    </a>
                                @endif
                            @else
                                <!-- Regular Business Contact (Basic) -->
                                @if($business->email)
                                    <span class="flex items-center space-x-1">
                                        <x-heroicon-s-envelope class="w-5 h-5" />
                                        <span>{{ $business->email }}</span>
                                    </span>
                                @endif
                                
                                @if($business->url)
                                    <span class="flex items-center space-x-1">
                                        <x-heroicon-s-globe-alt class="w-5 h-5" />
                                        <span>Visit Website</span>
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Business Description -->
        <div class="p-8 mb-8 bg-white shadow-lg dark:bg-gray-800 rounded-2xl">
            <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">About {{ $business->name }}</h2>
            <div class="prose prose-lg max-w-none dark:prose-invert">
                {!! $business->description !!}
            </div>
        </div>

        <!-- Contact Information -->
        @if($business->email || $business->url)
        <div class="p-8 mb-8 bg-white shadow-lg dark:bg-gray-800 rounded-2xl">
            <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Get in Touch</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                @if($business->email)
                    <div class="flex items-start space-x-3">
                        <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg dark:bg-green-900">
                            <x-heroicon-o-envelope class="w-5 h-5 text-green-600 dark:text-green-400" />
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white">Email</h3>
                            <a href="mailto:{{ $business->email }}" 
                               class="text-green-600 dark:text-green-400 hover:underline">
                                {{ $business->email }}
                            </a>
                        </div>
                    </div>
                @endif

                @if($business->url)
                    <div class="flex items-start space-x-3">
                        <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg dark:bg-blue-900">
                            <x-heroicon-o-globe-europe-africa  class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white">Website</h3>
                            <a href="{{ $business->url }}" target="_blank" 
                               class="text-blue-600 dark:text-blue-400 hover:underline">
                                {{ parse_url($business->url, PHP_URL_HOST) }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Navigation -->
        <div class="flex items-center justify-between">
            <a href="{{ route('public.businesses.index') }}" 
               class="flex items-center space-x-2 text-gray-600 transition-colors dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <x-heroicon-o-arrow-left class="w-5 h-5" />
                <span>Back to Business Directory</span>
            </a>
        </div>
    </div>
</x-zeus::layout>

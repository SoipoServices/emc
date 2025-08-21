<x-zeus::app :$skyTheme>
    <x-slot name="title">{{ $business->name }}</x-slot>

    <div class="max-w-4xl mx-auto">
        <!-- Business Header -->
        <div class="mb-8 overflow-hidden bg-white shadow-lg dark:bg-gray-800 rounded-2xl">
            @if($business->is_sponsor)
                <!-- Sponsor Badge -->
                <div class="px-6 py-2 text-center text-white bg-gradient-to-r from-yellow-400 to-yellow-600">
                    <div class="flex items-center justify-center space-x-2">
                        <span class="text-lg">⭐</span>
                        <span class="font-bold">COMMUNITY SPONSOR</span>
                        <span class="text-lg">⭐</span>
                    </div>
                </div>
            @endif

            <div class="p-8">
                <div class="flex flex-col items-start space-y-4 md:flex-row md:items-center md:space-y-0 md:space-x-6">
                    @if($business->logo_path)
                        <div class="flex-shrink-0">
                            <img src="{{ asset('storage/' . $business->logo_path) }}" 
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
                            @if($business->contact_email)
                                <a href="mailto:{{ $business->contact_email }}" 
                                   class="flex items-center space-x-1 transition-colors hover:text-green-600 dark:hover:text-green-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                    </svg>
                                    <span>{{ $business->contact_email }}</span>
                                </a>
                            @endif
                            
                            @if($business->website)
                                <a href="{{ $business->website }}" target="_blank" 
                                   class="flex items-center space-x-1 transition-colors hover:text-blue-600 dark:hover:text-blue-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.559-.499-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.559.499.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.497-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.148.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Visit Website</span>
                                </a>
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
        @if($business->contact_email || $business->website)
        <div class="p-8 mb-8 bg-white shadow-lg dark:bg-gray-800 rounded-2xl">
            <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Get in Touch</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                @if($business->contact_email)
                    <div class="flex items-start space-x-3">
                        <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg dark:bg-green-900">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white">Email</h3>
                            <a href="mailto:{{ $business->contact_email }}" 
                               class="text-green-600 dark:text-green-400 hover:underline">
                                {{ $business->contact_email }}
                            </a>
                        </div>
                    </div>
                @endif

                @if($business->website)
                    <div class="flex items-start space-x-3">
                        <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg dark:bg-blue-900">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.559-.499-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.559.499.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.497-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.148.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white">Website</h3>
                            <a href="{{ $business->website }}" target="_blank" 
                               class="text-blue-600 dark:text-blue-400 hover:underline">
                                {{ parse_url($business->website, PHP_URL_HOST) }}
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
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Back to Business Directory</span>
            </a>
        </div>
    </div>
</x-zeus::layout>

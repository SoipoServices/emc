<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('businesses.index') }}" method="GET" class="mb-6">
                    <input type="text" name="search" placeholder="Search companies..." value="{{ $search }}" class="w-full px-4 py-2 border rounded-md">
                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md">Search</button>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($businesses as $business)
                        <div class="border rounded-lg p-4">
                            <img src="{{ Storage::url($business->image) }}" alt="{{ $business->name }}" class="w-full h-48 object-cover mb-4 rounded">
                            <h3 class="text-xl font-semibold mb-2">{{ $business->name }}</h3>
                            <p class="text-gray-600 mb-2">{{ Str::limit($business->description, 100) }}</p>
                            @if ($business->url)
                                <a href="{{ $business->url }}" target="_blank" class="text-blue-500 hover:underline">Visit Website</a>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $businesses->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

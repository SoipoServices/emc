<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $business->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/3">
                        <img src="{{ Storage::url($business->image) }}" alt="{{ $business->name }}" class="w-full h-auto object-cover rounded-lg">
                    </div>
                    <div class="md:w-2/3 md:pl-6 mt-4 md:mt-0">
                        <h3 class="text-2xl font-bold mb-2">{{ $business->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $business->description }}</p>
                        <div class="mb-2">
                            <strong>Website:</strong> <a href="{{ $business->url }}" target="_blank" class="text-blue-500 hover:underline">{{ $business->url }}</a>
                        </div>
                        <div class="mb-2">
                            <strong>LinkedIn:</strong> <a href="{{ $business->linkedin_url }}" target="_blank" class="text-blue-500 hover:underline">{{ $business->linkedin_url }}</a>
                        </div>
                        <div class="mb-2">
                            <strong>Telephone:</strong> {{ $business->telephone }}
                        </div>
                        <div class="mb-2">
                            <strong>Email:</strong> {{ $business->email }}
                        </div>
                        @if (auth()->id() === $business->user_id)
                            <div class="mt-4">
                                <a href="{{ route('businesses.edit', $business) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                    Edit Business
                                </a>
                                <form action="{{ route('businesses.destroy', $business) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-300 disabled:opacity-25 transition" onclick="return confirm('Are you sure you want to delete this business?')">
                                        Delete Business
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

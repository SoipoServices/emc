<x-zeus::private-app :$skyTheme>
<div>
    <!-- Twitter-like Profile Header -->
    <div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Edit Event</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Update your event details</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('private.events.list', ['user' => auth()->id()]) }}" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-full hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Back to Events
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Event Form -->
    <div class="p-6">
        @if(session('success'))
            <div class="p-4 mb-6 text-green-700 bg-green-100 border border-green-400 rounded-2xl dark:bg-green-900 dark:border-green-600 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 mb-6 text-red-700 bg-red-100 border border-red-400 rounded-2xl dark:bg-red-900 dark:border-red-600 dark:text-red-300">
                <div class="font-semibold">Please fix the following errors:</div>
                <ul class="mt-2 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('private.events.update', ['user' => auth()->id(), 'event' => $event->id]) }}" method="POST" enctype="multipart/form-data" class="max-w-2xl space-y-6">
            @csrf
            @method('PUT')

            <!-- Event Image -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Image</label>
                <div class="flex items-center gap-4">
                    @if($event->photo_path)
                        <div class="w-24 h-24 overflow-hidden border-2 border-gray-300 rounded-2xl dark:border-gray-600">
                            <img src="{{ Storage::disk('public')->url($event->photo_path) }}" alt="Current event image" class="object-cover w-full h-full">
                        </div>
                    @else
                        <div class="flex items-center justify-center w-24 h-24 bg-gray-100 border-2 border-gray-300 border-dashed rounded-2xl dark:bg-gray-800 dark:border-gray-600">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" name="image" accept="image/*" id="event-image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Upload an image to replace the current one. Max file size: 1MB</p>
                        <p id="file-size-error" class="hidden mt-1 text-sm text-red-600 dark:text-red-400">File is too large. Please choose an image smaller than 1MB.</p>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Event Title -->
            <div class="space-y-2">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                    placeholder="What's the name of your event?">
                @error('title')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Event Description -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Description</label>
                <div class="relative tinymce-wrapper">
                    <textarea name="description" id="description" rows="8" required
                        class="w-full px-4 py-3 border border-gray-300 resize-none rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                        placeholder="Tell us about your event...">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Date and Time -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date & Time</label>
                    <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date', $event->start_date->format('Y-m-d\TH:i')) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date & Time</label>
                    <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date', $event->end_date->format('Y-m-d\TH:i')) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Event Location -->
            <div class="space-y-2">
                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Location</label>
                <input type="text" name="address" id="address" value="{{ old('address', $event->address) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                    placeholder="Where will your event take place?">
                @error('address')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Event Link -->
            <div class="space-y-2">
                <label for="link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Link (Optional)</label>
                <input type="url" name="link" id="link" value="{{ old('link', $event->link) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                    placeholder="https://example.com/event-registration">
                <p class="text-xs text-gray-500 dark:text-gray-400">Optional: Add a link for registration, tickets, or more information</p>
                @error('link')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Your event will be reviewed before being published
                </div>
                <button type="submit" class="flex items-center gap-2 px-6 py-3 text-white transition-colors bg-blue-600 rounded-2xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Event
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Include TinyMCE Editor Component with custom border radius -->
<x-tinymce-editor 
    selector="#description" 
    placeholder="Describe your event in detail..." 
    :extraConfig="['border_radius' => '1rem']"
/>

<!-- File validation script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // File input validation
    const fileInput = document.getElementById('event-image');
    const fileSizeError = document.getElementById('file-size-error');
    const submitButton = document.querySelector('button[type="submit"]');
    
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            
            if (file) {
                const maxSize = 1024 * 1024; // 1MB in bytes
                
                if (file.size > maxSize) {
                    // Show error message
                    fileSizeError.classList.remove('hidden');
                    
                    // Disable submit button
                    submitButton.disabled = true;
                    submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                    
                    // Clear the file input
                    fileInput.value = '';
                } else {
                    // Hide error message
                    fileSizeError.classList.add('hidden');
                    
                    // Enable submit button
                    submitButton.disabled = false;
                    submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }
        });
    }
});
</script>
</x-zeus::private-app>

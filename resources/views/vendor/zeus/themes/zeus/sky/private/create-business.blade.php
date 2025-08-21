<x-zeus::private-app :$skyTheme>
<div>
    <!-- Profile Header -->
    <div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Create Business</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Add a new business to the community directory</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-full hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Business Creation Form -->
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

        <form action="{{ route('private.businesses.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl space-y-6">
            @csrf

            <!-- Business Logo -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Business Logo</label>
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-24 h-24 bg-gray-100 border-2 border-gray-300 border-dashed rounded-2xl dark:bg-gray-800 dark:border-gray-600">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="logo" accept="image/*" id="business-logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 1MB</p>
                        <div id="file-size-error" class="hidden mt-1 text-sm text-red-600 dark:text-red-400">
                            File size must be less than 1MB. Please choose a smaller image.
                        </div>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Business Name -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Business Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white" placeholder="Enter business name">
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Business Description -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description <span class="text-red-500">*</span></label>
                <div class="tinymce-wrapper">
                    <textarea name="description" id="description" rows="8" required class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white" placeholder="Describe your business in detail...">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Business Contact Info -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white" placeholder="Business contact email">
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Website</label>
                <input type="url" name="url" id="url" value="{{ old('url') }}" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white" placeholder="https://yourbusiness.com">
                @error('url')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 text-sm font-medium text-white transition-colors bg-blue-800 rounded-lg hover:bg-blue-900 dark:bg-blue-700 dark:hover:bg-blue-800">
                    Create Business
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Load TinyMCE -->
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- TinyMCE Styling -->
<style>
.tinymce-wrapper .tox-tinymce {
    border-radius: 0.5rem !important;
    border-color: #d1d5db !important;
}

.dark .tinymce-wrapper .tox-tinymce {
    border-color: #4b5563 !important;
}

.tinymce-wrapper .tox-toolbar-overlord {
    border-top-left-radius: 0.5rem !important;
    border-top-right-radius: 0.5rem !important;
}

.tinymce-wrapper .tox-edit-area {
    border-bottom-left-radius: 0.5rem !important;
    border-bottom-right-radius: 0.5rem !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize TinyMCE
    tinymce.init({
        selector: '#description',
        height: 300,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
            'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'link table | removeformat code | help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; line-height: 1.6; }',
        skin: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide',
        content_css: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default',
        branding: false,
        elementpath: false,
        statusbar: false,
        block_formats: 'Paragraph=p; Header 3=h3; Header 4=h4; Header 5=h5; Header 6=h6;',
        valid_elements: 'p,br,strong,em,h3,h4,h5,h6,ul,ol,li,a[href],table,thead,tbody,tr,td,th',
        forced_root_block: 'p',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });

    // File input validation
    const fileInput = document.getElementById('business-logo');
    const submitButton = document.querySelector('button[type="submit"]');
    const errorDiv = document.getElementById('file-size-error');
    const maxSize = 1024 * 1024; // 1MB in bytes

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        
        if (file) {
            if (file.size > maxSize) {
                errorDiv.classList.remove('hidden');
                fileInput.value = ''; // Clear the input
                submitButton.disabled = true;
                submitButton.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                errorDiv.classList.add('hidden');
                submitButton.disabled = false;
                submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    });

    // Handle form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        // Make sure TinyMCE content is saved to textarea
        tinymce.triggerSave();
    });
});
</script>
</x-zeus::private-app>

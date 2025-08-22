@props([
    'selector' => '#description',
    'height' => 300,
    'placeholder' => 'Enter your description...',
    'extraConfig' => []
])

<!-- TinyMCE CDN Script -->
<script src="https://cdn.tiny.cloud/1/{{ config('tinymce.api_key') }}/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

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
    // Check if TinyMCE is already initialized for this selector
    if (window.tinymce && window.tinymce.get('{{ str_replace('#', '', $selector) }}')) {
        return; // Already initialized
    }

    // Initialize TinyMCE
    if (window.tinymce) {
        window.tinymce.init({
            selector: '{{ $selector }}',
            height: {{ $height }},
            menubar: false,
            branding: false,
            elementpath: false,
            statusbar: false,
            placeholder: '{{ $placeholder }}',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link table | removeformat code | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; line-height: 1.6; }',
            skin: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide',
            content_css: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default',
            block_formats: 'Paragraph=p; Header 3=h3; Header 4=h4; Header 5=h5; Header 6=h6;',
            valid_elements: 'p,br,strong,em,h3,h4,h5,h6,ul,ol,li,a[href],table,thead,tbody,tr,td,th',
            forced_root_block: 'p',
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
                
                @if(!empty($extraConfig))
                // Apply extra configuration
                @foreach($extraConfig as $key => $value)
                editor.options.{{ $key }} = {!! is_string($value) ? "'{$value}'" : json_encode($value) !!};
                @endforeach
                @endif
            },
            @if(!empty($extraConfig))
            @foreach($extraConfig as $key => $value)
            {{ $key }}: {!! is_string($value) ? "'{$value}'" : json_encode($value) !!},
            @endforeach
            @endif
        });
    }
});

// Add form submission handler
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // Make sure TinyMCE content is saved to textarea
            if (window.tinymce) {
                window.tinymce.triggerSave();
            }
        });
    });
});
</script>

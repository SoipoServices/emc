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
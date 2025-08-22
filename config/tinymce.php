<?php

return [

    /*
    |--------------------------------------------------------------------------
    | TinyMCE API Key
    |--------------------------------------------------------------------------
    |
    | The API key for TinyMCE editor. This is required for TinyMCE Cloud
    | to validate the domain and enable all features.
    |
    */

    'api_key' => env('TINYMCE_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Application Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL of the application. This is used to register the domain
    | with TinyMCE Cloud for license validation.
    |
    */

    'base_url' => env('APP_URL'),

    /*
    |--------------------------------------------------------------------------
    | TinyMCE Default Configuration
    |--------------------------------------------------------------------------
    |
    | Default configuration options for TinyMCE editor instances.
    |
    */

    'default_config' => [
        'height' => 300,
        'menubar' => false,
        'branding' => false,
        'elementpath' => false,
        'statusbar' => false,
        'plugins' => [
            'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
            'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'table', 'help', 'wordcount'
        ],
        'toolbar' => 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link table | removeformat code | help',
        'content_style' => 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; line-height: 1.6; }',
        'block_formats' => 'Paragraph=p; Header 3=h3; Header 4=h4; Header 5=h5; Header 6=h6;',
        'valid_elements' => 'p,br,strong,em,h3,h4,h5,h6,ul,ol,li,a[href],table,thead,tbody,tr,td,th',
        'forced_root_block' => 'p',
    ],

];

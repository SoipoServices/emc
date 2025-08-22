@use('Illuminate\Support\Facades\Storage')
@use('Illuminate\Support\Str')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}" class="antialiased filament js-focus-visible">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <!-- Seo Tags -->
    <x-seo::meta/>
    <!-- Seo Tags -->

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://events.humanitix.com/scripts/widgets/popup.js" type="module"></script>

    @livewireStyles
    @filamentStyles
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('vendor/zeus/frontend.css') }}">
    
    @env("production")
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MT88SH9T');</script>
        <!-- End Google Tag Manager -->
    @endenv
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    @env("production")
         <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MT88SH9T" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) --> 
    @endenv

    <div class=" bg-gray-50 dark:bg-gray-900">
        @include($skyTheme.'.partial.header')
        
        <!-- Main Content -->
        <main>
            {{ $slot }}
        </main>

        @include($skyTheme.'.partial.footer')
    </div>   
 @include($skyTheme.'.partial.footer-scripts')
</body>
</html>

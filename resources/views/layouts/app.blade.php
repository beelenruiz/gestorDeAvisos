<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CDn SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @livewireStyles

    @stack('styles')
    @stack('scripts')
</head>

<body class="font-sans antialiased" style="min-height: 100vh;">
    <x-banner />

    <div class="min-h-screen bg-white">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main style="min-height: screen;">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <script src="{{ asset('js/alerts.js') }}" defer></script>
    <script src="{{ asset('js/carrousel.js') }}" defer></script>
</body>

</html>
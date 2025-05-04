<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="rs-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Record Store</title>

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{ $slot }}

    {{-- Toast --}}
    <div class="toast transition-opacity duration-500 z-50">
        @if (session('success'))
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        @endif
    </div>

    {{-- Fullscreen gallery frame --}}
    <div
        class="rs-gallery-frame bg-base-100 fixed left-0 top-0 z-30 hidden h-screen w-screen items-center justify-center">
        <img class="gallery-frame-img aspect-square object-cover object-center" />

        {{-- This button doesn't actually do anything since the close is triggered by clicking anywhere  --}}
        <button class="btn btn-ghost btn-circle absolute right-4 top-4">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
</body>

</html>

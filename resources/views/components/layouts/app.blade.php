<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100 dark:bg-gray-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    @stack('customer-scripts')
</head>

<body class="min-h-screen">
    <div x-data="{ menuVisibility: false }">
        <x-side-bar></x-side-bar>

        <x-navigation />
        <div class="flex flex-col md:pl-64">
            @if (@session()->has('impersonate'))
                <div class="flex gap-x-2 justify-center items-center py-2.5 w-full text-white bg-indigo-600">
                    <span class="text-sm">You Are Impersonating as <strong>{{ Auth::user()->name }}</strong></span>
                    <a class="underline" href="{{ route('impersonate.leave') }}"> Leave Impersonating </a>
                </div>
            @endif
            <main class="flex-1">
                <div class="py-6">
                    {{ $slot }}
                </div>
            </main>
        </div>

    </div>

    @livewireScriptConfig
</body>

</html>

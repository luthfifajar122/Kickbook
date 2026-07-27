<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KickBook')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-blue-600">⚽ KickBook</a>
                    <div class="hidden sm:flex items-center gap-6">
                        <a href="{{ route('customer.lapangan.index') }}"
                           class="{{ request()->routeIs('customer.lapangan.*') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }} transition">
                            Lapangan
                        </a>
                        <a href="{{ route('booking.index') }}"
                           class="{{ request()->routeIs('booking.*') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }} transition">
                            Booking Saya
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500 hidden sm:block">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm transition">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>

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
<body class="bg-slate-50 font-sans antialiased text-slate-800">

    <nav class="bg-white/90 backdrop-blur border-b border-slate-200 sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-xl font-bold tracking-tight text-slate-900"><span class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-black">K</span> KickBook</a>
                    <div class="hidden sm:flex items-center gap-6 text-sm">
                        <a href="{{ route('customer.lapangan.index') }}"
                           class="{{ request()->routeIs('customer.lapangan.*') ? 'text-blue-700 font-semibold' : 'text-slate-600 hover:text-blue-700' }} transition">
                            Lapangan
                        </a>
                        <a href="{{ route('booking.index') }}"
                           class="{{ request()->routeIs('booking.*') ? 'text-blue-700 font-semibold' : 'text-slate-600 hover:text-blue-700' }} transition">
                            Booking Saya
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-slate-500 hidden sm:block">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn-secondary !px-4 !py-2 !text-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-[70vh]">
        @yield('content')
    </main>
    <footer class="mt-16 border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-slate-500">
            <p class="font-semibold text-slate-800">KickBook</p>
            <p>Sistem Booking Lapangan Futsal &copy; {{ date('Y') }}</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

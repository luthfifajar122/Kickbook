<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KickBook Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-5 border-b border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold">⚽ KickBook</a>
            </div>

            <nav class="flex-1 p-4">
                <ul class="space-y-1">
                    @php
                        $menu = [
                            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                            ['label' => 'Lapangan', 'route' => 'admin.lapangan.index', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                            ['label' => 'Jadwal', 'route' => 'admin.jadwal.index', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                            ['label' => 'Booking', 'route' => 'admin.booking.index', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                            ['label' => 'Pembayaran', 'route' => 'admin.pembayaran.index', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ];
                    @endphp

                    @foreach($menu as $item)
                        <li>
                            <a href="{{ route($item['route']) }}"
                               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
                                      {{ request()->routeIs($item['route']) || request()->routeIs($item['route'] . '.*')
                                         ? 'bg-blue-600 text-white shadow-lg'
                                         : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                                </svg>
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center gap-3 text-gray-300 hover:text-white w-full px-4 py-2.5 rounded-lg hover:bg-gray-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Content -->
        <main class="flex-1">
            <div class="p-8">
                @yield('content')
            </div>
        </main>

    </div>

</body>
</html>

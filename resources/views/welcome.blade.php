<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KickBook - Booking Lapangan Futsal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased">

    <!-- Navbar -->
    <nav class="bg-white/90 backdrop-blur border-b border-slate-200 fixed w-full z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2 text-xl font-bold tracking-tight">
                    <span class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-black">K</span> KickBook
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                           class="text-sm font-medium text-slate-600 hover:text-blue-700">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn-secondary !px-4 !py-2 !text-sm">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-blue-700">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary !px-5 !py-2 !text-sm">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="pt-28 pb-16 sm:pb-20 bg-gradient-to-br from-blue-700 via-blue-600 to-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 border border-white/20 text-xs font-semibold tracking-wide mb-5">BOOKING LAPANGAN FUTSAL ONLINE</span>
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight mb-6">Booking Lapangan Futsal<br class="hidden sm:block"> Jadi Lebih Mudah</h1>
            <p class="text-lg md:text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Cari, pesan, dan bayar lapangan futsal favoritmu secara online. 
                Tanpa ribet, tanpa antri.
            </p>
            @auth
                <a href="{{ route('customer.lapangan.index') }}" 
                   class="inline-block bg-white text-blue-700 font-semibold px-8 py-3 rounded-xl hover:bg-blue-50 transition shadow-lg">
                    Lihat Lapangan
                </a>
            @else
                <a href="{{ route('register') }}" 
                   class="inline-block bg-white text-blue-700 font-semibold px-8 py-3 rounded-xl hover:bg-blue-50 transition shadow-lg">
                    Mulai Sekarang
                </a>
            @endauth
        </div>
    </section>

    <!-- Fitur -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-center mb-3">Kenapa KickBook?</h2>
            <p class="text-slate-500 text-center mb-10 max-w-xl mx-auto">Semua kebutuhan booking futsal dalam satu tempat yang rapi dan cepat.</p>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="text-center p-6">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Booking Online</h3>
                    <p class="text-gray-500">Pesan lapangan kapan saja, di mana saja tanpa perlu datang langsung.</p>
                </div>
                <div class="text-center p-6">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Harga Transparan</h3>
                    <p class="text-gray-500">Lihat harga per jam sebelum booking, tanpa biaya tersembunyi.</p>
                </div>
                <div class="text-center p-6">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Aman & Terpercaya</h3>
                    <p class="text-gray-500">Sistem pembayaran aman dengan riwayat booking yang lengkap.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Booking -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Cara Booking</h2>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 text-xl font-bold">1</div>
                    <h4 class="font-semibold">Daftar Akun</h4>
                    <p class="text-gray-500 text-sm">Buat akun gratis</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 text-xl font-bold">2</div>
                    <h4 class="font-semibold">Pilih Lapangan</h4>
                    <p class="text-gray-500 text-sm">Cari jadwal yang cocok</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 text-xl font-bold">3</div>
                    <h4 class="font-semibold">Booking & Bayar</h4>
                    <p class="text-gray-500 text-sm">Konfirmasi pembayaran</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 text-xl font-bold">4</div>
                    <h4 class="font-semibold">Main Futsal!</h4>
                    <p class="text-gray-500 text-sm">Datang dan bermain</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="text-xl font-bold text-white mb-2">KickBook</div>
                <p class="mb-4">Sistem Booking Lapangan Futsal</p>
                <p>&copy; {{ date('Y') }} KickBook. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>

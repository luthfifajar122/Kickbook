@extends('layouts.customer')

@section('title', 'Dashboard')

@section('content')
<div class="bg-gradient-to-br from-blue-700 via-blue-600 to-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Selamat Datang, {{ Auth::user()->name }}</h1>
        <p class="text-blue-100 mt-2">Kelola booking lapangan futsal kamu di sini.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 pb-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <a href="{{ route('customer.lapangan.index') }}"
           class="card card-hover p-6 border-b-4 !border-b-blue-500">
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center mb-4"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></div>
            <h3 class="font-bold">Lihat Lapangan</h3>
            <p class="text-slate-500 text-sm mt-1">Cari lapangan yang tersedia</p>
        </a>

        <a href="{{ route('booking.create') }}"
           class="card card-hover p-6 border-b-4 !border-b-emerald-500">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-4"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
            <h3 class="font-bold">Booking Lapangan</h3>
            <p class="text-slate-500 text-sm mt-1">Pesan lapangan futsal sekarang</p>
        </a>

        <a href="{{ route('booking.index') }}"
           class="card card-hover p-6 border-b-4 !border-b-violet-500">
            <div class="w-11 h-11 rounded-xl bg-violet-50 text-violet-700 flex items-center justify-center mb-4"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg></div>
            <h3 class="font-bold">Booking Saya</h3>
            <p class="text-slate-500 text-sm mt-1">Lihat riwayat booking Anda</p>
        </a>
    </div>
</div>
@endsection

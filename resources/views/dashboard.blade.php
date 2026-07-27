@extends('layouts.customer')

@section('title', 'Dashboard')

@section('content')
<div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-blue-100 mt-2 text-lg">Kelola booking lapangan futsal kamu di sini.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('customer.lapangan.index') }}"
           class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-b-4 border-blue-500">
            <div class="text-4xl mb-3">⚽</div>
            <h3 class="font-bold text-lg">Lihat Lapangan</h3>
            <p class="text-gray-500 text-sm mt-1">Cari lapangan yang tersedia</p>
        </a>

        <a href="{{ route('booking.create') }}"
           class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-b-4 border-green-500">
            <div class="text-4xl mb-3">📅</div>
            <h3 class="font-bold text-lg">Booking Lapangan</h3>
            <p class="text-gray-500 text-sm mt-1">Pesan lapangan futsal sekarang</p>
        </a>

        <a href="{{ route('booking.index') }}"
           class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-b-4 border-purple-500">
            <div class="text-4xl mb-3">📋</div>
            <h3 class="font-bold text-lg">Booking Saya</h3>
            <p class="text-gray-500 text-sm mt-1">Lihat riwayat booking Anda</p>
        </a>
    </div>
</div>
@endsection

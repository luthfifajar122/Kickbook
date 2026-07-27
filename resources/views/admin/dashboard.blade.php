@extends('layouts.admin')

@section('title', '')

@section('content')

<div class="mb-8">
    <h2 class="text-2xl font-bold">Dashboard</h2>
    <p class="text-gray-500 mt-1">Selamat Datang Admin 👋</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Total Lapangan</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalLapangan }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Total Booking</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalBooking }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Total Customer</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalCustomer }}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Booking Hari Ini</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $bookingHariIni }}</p>
            </div>
            <div class="bg-orange-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
    </div>

</div>

<div class="mt-8 bg-white rounded-lg shadow p-6">
    <h3 class="font-semibold text-lg mb-2">Akses Cepat</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
        <a href="{{ route('admin.lapangan.index') }}" class="bg-blue-50 hover:bg-blue-100 rounded-lg p-4 text-center transition">
            <p class="text-2xl mb-1">🏟️</p>
            <p class="text-sm font-medium text-blue-700">Kelola Lapangan</p>
        </a>
        <a href="{{ route('admin.jadwal.index') }}" class="bg-green-50 hover:bg-green-100 rounded-lg p-4 text-center transition">
            <p class="text-2xl mb-1">📅</p>
            <p class="text-sm font-medium text-green-700">Atur Jadwal</p>
        </a>
        <a href="{{ route('admin.booking.index') }}" class="bg-purple-50 hover:bg-purple-100 rounded-lg p-4 text-center transition">
            <p class="text-2xl mb-1">📋</p>
            <p class="text-sm font-medium text-purple-700">Lihat Booking</p>
        </a>
        <a href="{{ route('admin.pembayaran.index') }}" class="bg-orange-50 hover:bg-orange-100 rounded-lg p-4 text-center transition">
            <p class="text-2xl mb-1">💰</p>
            <p class="text-sm font-medium text-orange-700">Verifikasi Bayar</p>
        </a>
    </div>
</div>

@endsection

@extends('layouts.admin')

@section('title', 'Detail Booking')

@section('content')

<a href="{{ route('admin.booking.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Kembali</a>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Informasi Booking</h3>
        <table class="w-full">
            <tr class="border-b"><td class="py-2 text-gray-600 w-1/3">ID Booking</td><td class="py-2 font-medium">#{{ $booking->id }}</td></tr>
            <tr class="border-b"><td class="py-2 text-gray-600">Tanggal</td><td class="py-2 font-medium">{{ \Carbon\Carbon::parse($booking->tanggal)->isoFormat('D MMM Y') }}</td></tr>
            <tr class="border-b"><td class="py-2 text-gray-600">Jam</td><td class="py-2 font-medium">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td></tr>
            <tr class="border-b"><td class="py-2 text-gray-600">Total Harga</td><td class="py-2 font-medium">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td></tr>
            <tr>
                <td class="py-2 text-gray-600">Status</td>
                <td class="py-2">
                    @php $sc = match($booking->status) { 'Pending' => 'bg-yellow-100 text-yellow-700', 'Dibayar' => 'bg-blue-100 text-blue-700', 'Selesai' => 'bg-green-100 text-green-700', 'Dibatalkan' => 'bg-red-100 text-red-700' }; @endphp
                    <span class="px-2 py-1 rounded text-sm font-medium {{ $sc }}">{{ $booking->status }}</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Customer</h3>
        <table class="w-full">
            <tr class="border-b"><td class="py-2 text-gray-600 w-1/3">Nama</td><td class="py-2 font-medium">{{ $booking->user->name }}</td></tr>
            <tr class="border-b"><td class="py-2 text-gray-600">Email</td><td class="py-2 font-medium">{{ $booking->user->email }}</td></tr>
            <tr><td class="py-2 text-gray-600">Bergabung</td><td class="py-2 font-medium">{{ $booking->user->created_at->isoFormat('D MMM Y') }}</td></tr>
        </table>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Lapangan</h3>
        <table class="w-full">
            <tr class="border-b"><td class="py-2 text-gray-600 w-1/3">Nama</td><td class="py-2 font-medium">{{ $booking->lapangan->nama }}</td></tr>
            <tr class="border-b"><td class="py-2 text-gray-600">Jenis</td><td class="py-2 font-medium">{{ $booking->lapangan->jenis }}</td></tr>
            <tr><td class="py-2 text-gray-600">Harga/Jam</td><td class="py-2 font-medium">Rp {{ number_format($booking->lapangan->harga_per_jam, 0, ',', '.') }}</td></tr>
        </table>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Pembayaran</h3>
        @if($booking->pembayaran)
            <table class="w-full">
                <tr class="border-b"><td class="py-2 text-gray-600 w-1/3">Metode</td><td class="py-2 font-medium capitalize">{{ $booking->pembayaran->metode }}</td></tr>
                <tr class="border-b"><td class="py-2 text-gray-600">Total Bayar</td><td class="py-2 font-medium">Rp {{ number_format($booking->pembayaran->total_bayar, 0, ',', '.') }}</td></tr>
                <tr>
                    <td class="py-2 text-gray-600">Status</td>
                    <td class="py-2">
                        @php $pc = match($booking->pembayaran->status) { 'Pending' => 'bg-yellow-100 text-yellow-700', 'Diverifikasi' => 'bg-green-100 text-green-700', 'Gagal' => 'bg-red-100 text-red-700' }; @endphp
                        <span class="px-2 py-1 rounded text-sm font-medium {{ $pc }}">{{ $booking->pembayaran->status }}</span>
                    </td>
                </tr>
            </table>
            @if($booking->pembayaran->bukti_bayar)
                <a href="{{ asset('storage/' . $booking->pembayaran->bukti_bayar) }}" target="_blank" class="text-blue-600 hover:underline text-sm mt-2 inline-block">Lihat Bukti Bayar</a>
            @endif
        @else
            <p class="text-gray-400">Belum ada pembayaran.</p>
        @endif
    </div>

    @if($booking->ulasan)
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Ulasan</h3>
        <div class="flex items-center gap-1 mb-2">
            @for($i = 1; $i <= 5; $i++)
                <span class="{{ $i <= $booking->ulasan->rating ? 'text-yellow-400' : 'text-gray-300' }} text-xl">★</span>
            @endfor
            <span class="ml-2 text-gray-600">({{ $booking->ulasan->rating }}/5)</span>
        </div>
        @if($booking->ulasan->komentar)
            <p class="text-gray-700 italic">"{{ $booking->ulasan->komentar }}"</p>
        @endif
        <p class="text-xs text-gray-400 mt-2">oleh {{ $booking->ulasan->user->name ?? $booking->user->name }}</p>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Ubah Status</h3>
        <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')
            <select name="status" class="w-full border rounded p-2 mb-4 @error('status') border-red-500 @enderror">
                <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Dibayar" {{ $booking->status == 'Dibayar' ? 'selected' : '' }}>Dibayar</option>
                <option value="Selesai" {{ $booking->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Dibatalkan" {{ $booking->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            @error('status')<p class="text-red-500 text-sm mt-1 mb-2">{{ $message }}</p>@enderror
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">Update Status</button>
        </form>
    </div>

</div>

@endsection

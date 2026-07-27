@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('content')

<a href="{{ route('admin.pembayaran.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Kembali</a>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Informasi Pembayaran</h3>
        <table class="w-full">
            <tr class="border-b"><td class="py-2 text-gray-600 w-1/3">ID Pembayaran</td><td class="py-2 font-medium">#{{ $pembayaran->id }}</td></tr>
            <tr class="border-b"><td class="py-2 text-gray-600">Booking</td><td class="py-2 font-medium">#{{ $pembayaran->booking_id }} - {{ $pembayaran->booking->lapangan->nama }}</td></tr>
            <tr class="border-b"><td class="py-2 text-gray-600">Customer</td><td class="py-2 font-medium">{{ $pembayaran->booking->user->name }}</td></tr>
            <tr class="border-b"><td class="py-2 text-gray-600">Metode</td><td class="py-2 font-medium capitalize">{{ $pembayaran->metode }}</td></tr>
            <tr class="border-b"><td class="py-2 text-gray-600">Total Bayar</td><td class="py-2 font-medium text-lg">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td></tr>
            <tr>
                <td class="py-2 text-gray-600">Status</td>
                <td class="py-2">
                    @php
                        $cls = match($pembayaran->status) {
                            'Pending' => 'bg-yellow-100 text-yellow-700',
                            'Diverifikasi' => 'bg-green-100 text-green-700',
                            'Gagal' => 'bg-red-100 text-red-700',
                        };
                    @endphp
                    <span class="px-2 py-1 rounded text-sm font-medium {{ $cls }}">{{ $pembayaran->status }}</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Bukti Bayar</h3>
        @if($pembayaran->bukti_bayar)
            <img src="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" class="max-w-full rounded border">
        @else
            <p class="text-gray-500">Tidak ada bukti bayar (pembayaran tunai).</p>
        @endif
    </div>

    @if($pembayaran->status === 'Pending')
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Verifikasi Pembayaran</h3>
        <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="flex gap-3">
                <button type="submit" name="status" value="Diverifikasi"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded"
                        onclick="return confirm('Verifikasi pembayaran ini?')">
                    ✓ Verifikasi
                </button>
                <button type="submit" name="status" value="Gagal"
                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded"
                        onclick="return confirm('Tolak pembayaran ini?')">
                    ✕ Tolak
                </button>
            </div>
        </form>
    </div>
    @endif

</div>

@endsection

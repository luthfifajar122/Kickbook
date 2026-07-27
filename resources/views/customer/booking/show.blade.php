@extends('layouts.customer')

@section('title', 'Detail Booking')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
        @endif

        <a href="{{ route('booking.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Kembali</a>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-6">Detail Booking</h2>

            <table class="w-full">
                <tr class="border-b"><td class="py-3 text-gray-600 w-1/3">ID Booking</td><td class="py-3 font-medium">#{{ $booking->id }}</td></tr>
                <tr class="border-b"><td class="py-3 text-gray-600">Lapangan</td><td class="py-3 font-medium">{{ $booking->lapangan->nama }} ({{ $booking->lapangan->jenis }})</td></tr>
                <tr class="border-b"><td class="py-3 text-gray-600">Tanggal</td><td class="py-3 font-medium">{{ \Carbon\Carbon::parse($booking->tanggal)->isoFormat('D MMMM Y') }}</td></tr>
                <tr class="border-b"><td class="py-3 text-gray-600">Jam</td><td class="py-3 font-medium">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td></tr>
                <tr class="border-b"><td class="py-3 text-gray-600">Total Harga</td><td class="py-3 font-medium text-lg">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td></tr>
                <tr class="border-b">
                    <td class="py-3 text-gray-600">Status</td>
                    <td class="py-3">
                        @php $cls = match($booking->status) { 'Pending' => 'bg-yellow-100 text-yellow-700', 'Dibayar' => 'bg-blue-100 text-blue-700', 'Selesai' => 'bg-green-100 text-green-700', 'Dibatalkan' => 'bg-red-100 text-red-700' }; @endphp
                        <span class="px-3 py-1 rounded text-sm font-medium {{ $cls }}">{{ $booking->status }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="py-3 text-gray-600">Pembayaran</td>
                    <td class="py-3">
                        @if($booking->pembayaran)
                            @php $pCls = match($booking->pembayaran->status) { 'Pending' => 'bg-yellow-100 text-yellow-700', 'Diverifikasi' => 'bg-green-100 text-green-700', 'Gagal' => 'bg-red-100 text-red-700' }; @endphp
                            <span class="px-3 py-1 rounded text-sm font-medium {{ $pCls }}">{{ $booking->pembayaran->status }}</span>
                        @else
                            <span class="text-gray-400">Belum dibayar</span>
                        @endif
                    </td>
                </tr>
            </table>

            <div class="mt-6 flex flex-wrap gap-3">

                @if($booking->status === 'Pending' && !$booking->pembayaran)
                    <a href="{{ route('pembayaran.create', $booking->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded">
                        Bayar Sekarang
                    </a>
                @endif

                @if($booking->status === 'Selesai' && !$booking->ulasan)
                    <a href="{{ route('ulasan.create', $booking->id) }}" class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded">
                        Beri Ulasan
                    </a>
                @endif

                @if($booking->ulasan)
                    <div class="text-sm text-gray-500 flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $booking->ulasan->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        @endfor
                        <span class="ml-1">- {{ $booking->ulasan->komentar ?: '(tanpa komentar)' }}</span>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection

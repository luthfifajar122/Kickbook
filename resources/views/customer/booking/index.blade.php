@extends('layouts.customer')

@section('title', 'Booking Saya')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Booking Saya</h2>
            <a href="{{ route('booking.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                + Booking Baru
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="p-3">Lapangan</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Jam</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($bookings->count())
                        @foreach($bookings as $booking)
                    <tr class="border-t">
                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3">{{ $booking->lapangan->nama }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($booking->tanggal)->isoFormat('D MMM Y') }}</td>
                            <td class="p-3">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                            <td class="p-3">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                            <td class="p-3">
                                @php
                                    $class = match($booking->status) {
                                        'Pending' => 'bg-yellow-100 text-yellow-700',
                                        'Dibayar' => 'bg-blue-100 text-blue-700',
                                        'Selesai' => 'bg-green-100 text-green-700',
                                        'Dibatalkan' => 'bg-red-100 text-red-700',
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded text-sm font-medium {{ $class }}">
                                    {{ $booking->status }}
                                </span>
                                @if($booking->pembayaran)
                                    <span class="block text-xs text-gray-400 mt-0.5">
                                        Bayar: {{ $booking->pembayaran->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-3">
                                <a href="{{ route('booking.show', $booking->id) }}"
                                   class="text-blue-600 hover:underline text-sm">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center p-5">
                                Belum ada booking.
                                <a href="{{ route('booking.create') }}" class="text-blue-600 hover:underline">Booking sekarang</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

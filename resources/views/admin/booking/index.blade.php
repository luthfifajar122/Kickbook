@extends('layouts.admin')

@section('title', 'Data Booking')

@section('content')

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Data Booking</h2>
    <a href="{{ route('admin.booking.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Tambah Booking
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3">No</th>
                <th class="p-3">Customer</th>
                <th class="p-3">Lapangan</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Jam</th>
                <th class="p-3">Total Harga</th>
                <th class="p-3">Status</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($bookings->count())
                @foreach($bookings as $booking)
                    <tr class="border-t">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $booking->user->name }}</td>
                        <td class="p-3">{{ $booking->lapangan->nama }}</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($booking->tanggal)->isoFormat('D MMM Y') }}</td>
                        <td class="p-3">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                        <td class="p-3">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                        <td class="p-3">
                            @php
                                $statusClass = match($booking->status) {
                                    'Pending' => 'bg-yellow-100 text-yellow-700',
                                    'Dibayar' => 'bg-blue-100 text-blue-700',
                                    'Selesai' => 'bg-green-100 text-green-700',
                                    'Dibatalkan' => 'bg-red-100 text-red-700',
                                };
                            @endphp
                            <span class="px-2 py-1 rounded text-sm font-medium {{ $statusClass }}">
                                {{ $booking->status }}
                            </span>
                            @if($booking->pembayaran)
                                <span class="block text-xs text-gray-400 mt-0.5">{{ $booking->pembayaran->status }}</span>
                            @endif
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.booking.show', $booking->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                Detail
                            </a>
                            <form action="{{ route('admin.booking.destroy', $booking->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center p-5">Belum ada data booking.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

@endsection

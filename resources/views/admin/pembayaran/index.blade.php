@extends('layouts.admin')

@section('title', 'Data Pembayaran')

@section('content')

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
@endif

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Data Pembayaran</h2>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3">No</th>
                <th class="p-3">Booking</th>
                <th class="p-3">Customer</th>
                <th class="p-3">Metode</th>
                <th class="p-3">Total</th>
                <th class="p-3">Status</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($pembayarans->count())
                @foreach($pembayarans as $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">#{{ $p->booking_id }} - {{ $p->booking->lapangan->nama }}</td>
                        <td class="p-3">{{ $p->booking->user->name }}</td>
                        <td class="p-3 capitalize">{{ $p->metode }}</td>
                        <td class="p-3">Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
                        <td class="p-3">
                            @php
                                $cls = match($p->status) {
                                    'Pending' => 'bg-yellow-100 text-yellow-700',
                                    'Diverifikasi' => 'bg-green-100 text-green-700',
                                    'Gagal' => 'bg-red-100 text-red-700',
                                };
                            @endphp
                            <span class="px-2 py-1 rounded text-sm font-medium {{ $cls }}">{{ $p->status }}</span>
                        </td>
                        <td class="p-3">
                            <a href="{{ route('admin.pembayaran.show', $p->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">Detail</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="7" class="text-center p-5">Belum ada data pembayaran.</td></tr>
            @endif
        </tbody>
    </table>
</div>

@endsection

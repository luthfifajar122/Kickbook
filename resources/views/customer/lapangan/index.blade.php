@extends('layouts.customer')

@section('title', 'Lapangan Tersedia')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold">Lapangan Tersedia</h2>
            <p class="text-gray-500 mt-2">Pilih lapangan favoritmu dan booking sekarang!</p>
        </div>

        @if($lapangans->isEmpty())
            <div class="bg-white rounded-lg shadow p-10 text-center">
                <p class="text-gray-500 text-lg">Belum ada lapangan tersedia saat ini.</p>
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($lapangans as $lapangan)
                    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                        @if($lapangan->foto)
                            <img src="{{ asset('storage/' . $lapangan->foto) }}" alt="{{ $lapangan->nama }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white text-6xl">
                                ⚽
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="text-xl font-bold mb-1">{{ $lapangan->nama }}</h3>
                            <p class="text-gray-500 text-sm mb-3">{{ $lapangan->jenis }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-blue-600">
                                    Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                                    <span class="text-sm font-normal text-gray-500">/jam</span>
                                </span>
                                <a href="{{ route('booking.create', $lapangan->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                    Booking
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection

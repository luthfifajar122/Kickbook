@extends('layouts.customer')

@section('title', 'Lapangan Tersedia')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="text-center mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight">Lapangan Tersedia</h2>
            <p class="text-slate-500 mt-2">Pilih lapangan favoritmu dan booking sekarang.</p>
        </div>

        @if($lapangans->isEmpty())
            <div class="card p-10 text-center">
                <p class="text-slate-500 text-lg">Belum ada lapangan tersedia saat ini.</p>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($lapangans as $lapangan)
                    <div class="card card-hover overflow-hidden">
                        @if($lapangan->foto)
                            <img src="{{ asset('storage/' . $lapangan->foto) }}" alt="{{ $lapangan->nama }}"
                                 class="w-full aspect-[16/10] object-cover">
                        @else
                            <div class="w-full aspect-[16/10] bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center text-white/70">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="font-bold">{{ $lapangan->nama }}</h3>
                            <p class="text-slate-500 text-sm mb-3">{{ $lapangan->jenis }}</p>
                            <div class="flex justify-between items-center gap-3">
                                <span class="text-xl font-bold text-blue-700">
                                    Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                                    <span class="text-sm font-normal text-slate-500">/jam</span>
                                </span>
                                <a href="{{ route('booking.create', $lapangan->id) }}"
                                   class="btn-primary !px-4 !py-2 !text-sm shrink-0">
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

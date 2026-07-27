@extends('layouts.admin')

@section('title', 'Tambah Booking')

@section('content')

<form action="{{ route('admin.booking.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label>Customer</label>
        <select name="user_id" class="w-full border rounded p-2 @error('user_id') border-red-500 @enderror">
            <option value="">-- Pilih Customer --</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('user_id') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }} ({{ $customer->email }})
                </option>
            @endforeach
        </select>
        @error('user_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Lapangan</label>
        <select name="lapangan_id" class="w-full border rounded p-2 @error('lapangan_id') border-red-500 @enderror">
            <option value="">-- Pilih Lapangan --</option>
            @foreach($lapangans as $lapangan)
                <option value="{{ $lapangan->id }}" {{ old('lapangan_id') == $lapangan->id ? 'selected' : '' }}>
                    {{ $lapangan->nama }} - Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}/jam
                </option>
            @endforeach
        </select>
        @error('lapangan_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Tanggal</label>
        <input type="date" name="tanggal" value="{{ old('tanggal') }}"
               class="w-full border rounded p-2 @error('tanggal') border-red-500 @enderror">
        @error('tanggal')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="mb-4">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}"
                   class="w-full border rounded p-2 @error('jam_mulai') border-red-500 @enderror">
            @error('jam_mulai')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}"
                   class="w-full border rounded p-2 @error('jam_selesai') border-red-500 @enderror">
            @error('jam_selesai')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        Simpan Booking
    </button>
</form>

@endsection

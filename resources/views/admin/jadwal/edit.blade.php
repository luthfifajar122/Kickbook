@extends('layouts.admin')

@section('title', 'Edit Jadwal')

@section('content')

<form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label>Lapangan</label>
        <select name="lapangan_id"
                class="w-full border rounded p-2 @error('lapangan_id') border-red-500 @enderror">
            <option value="">-- Pilih Lapangan --</option>
            @foreach($lapangans as $lapangan)
                <option value="{{ $lapangan->id }}" {{ old('lapangan_id', $jadwal->lapangan_id) == $lapangan->id ? 'selected' : '' }}>
                    {{ $lapangan->nama }}
                </option>
            @endforeach
        </select>
        @error('lapangan_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Hari</label>
        <select name="hari"
                class="w-full border rounded p-2 @error('hari') border-red-500 @enderror">
            <option value="">-- Pilih Hari --</option>
            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>{{ $hari }}</option>
            @endforeach
        </select>
        @error('hari')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Jam Mulai</label>
        <input type="time"
               name="jam_mulai"
               value="{{ old('jam_mulai', $jadwal->jam_mulai) }}"
               class="w-full border rounded p-2 @error('jam_mulai') border-red-500 @enderror">
        @error('jam_mulai')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Jam Selesai</label>
        <input type="time"
               name="jam_selesai"
               value="{{ old('jam_selesai', $jadwal->jam_selesai) }}"
               class="w-full border rounded p-2 @error('jam_selesai') border-red-500 @enderror">
        @error('jam_selesai')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Status</label>
        <select name="status"
                class="w-full border rounded p-2 @error('status') border-red-500 @enderror">
            <option value="Tersedia" {{ old('status', $jadwal->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="Tidak Tersedia" {{ old('status', $jadwal->status) == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
        </select>
        @error('status')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        Update
    </button>

</form>

@endsection

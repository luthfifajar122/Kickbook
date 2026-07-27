@extends('layouts.admin')

@section('title', 'Tambah Lapangan')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    Tambah Lapangan
</h2>

<form action="{{ route('admin.lapangan.store') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <div class="mb-4">
        <label>Nama Lapangan</label>
        <input type="text"
               name="nama"
               value="{{ old('nama') }}"
               class="w-full border rounded p-2 @error('nama') border-red-500 @enderror">
        @error('nama')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Jenis</label>
        <select name="jenis"
                class="w-full border rounded p-2 @error('jenis') border-red-500 @enderror">
            <option value="">-- Pilih Jenis --</option>
            <option value="Sintetis" {{ old('jenis') == 'Sintetis' ? 'selected' : '' }}>Sintetis</option>
            <option value="Vinyl" {{ old('jenis') == 'Vinyl' ? 'selected' : '' }}>Vinyl</option>
            <option value="Rumput" {{ old('jenis') == 'Rumput' ? 'selected' : '' }}>Rumput</option>
        </select>
        @error('jenis')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Harga / Jam</label>
        <input type="number"
               name="harga_per_jam"
               value="{{ old('harga_per_jam') }}"
               class="w-full border rounded p-2 @error('harga_per_jam') border-red-500 @enderror">
        @error('harga_per_jam')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Foto</label>
        <input type="file"
               name="foto"
               class="w-full border rounded p-2 @error('foto') border-red-500 @enderror">
        @error('foto')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Status</label>
        <select name="status"
                class="w-full border rounded p-2 @error('status') border-red-500 @enderror">
            <option value="Tersedia" {{ old('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="Maintenance" {{ old('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
        </select>
        @error('status')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button
        class="bg-blue-600 text-white px-5 py-2 rounded">
        Simpan
    </button>

</form>

@endsection
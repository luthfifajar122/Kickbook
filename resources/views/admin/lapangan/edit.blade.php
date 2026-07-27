@extends('layouts.admin')

@section('title', 'Edit Lapangan')

@section('content')

<form action="{{ route('admin.lapangan.update', $lapangan->id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="mb-4">
        <label>Nama Lapangan</label>
        <input type="text"
               name="nama"
               value="{{ old('nama', $lapangan->nama) }}"
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
            <option value="Sintetis" {{ old('jenis', $lapangan->jenis) == 'Sintetis' ? 'selected' : '' }}>Sintetis</option>
            <option value="Vinyl" {{ old('jenis', $lapangan->jenis) == 'Vinyl' ? 'selected' : '' }}>Vinyl</option>
            <option value="Rumput" {{ old('jenis', $lapangan->jenis) == 'Rumput' ? 'selected' : '' }}>Rumput</option>
        </select>
        @error('jenis')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Harga / Jam</label>
        <input type="number"
               name="harga_per_jam"
               value="{{ old('harga_per_jam', $lapangan->harga_per_jam) }}"
               class="w-full border rounded p-2 @error('harga_per_jam') border-red-500 @enderror">
        @error('harga_per_jam')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Foto</label>
        @if($lapangan->foto)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $lapangan->foto) }}"
                     class="w-32 h-32 object-cover rounded">
            </div>
        @endif
        <input type="file"
               name="foto"
               class="w-full border rounded p-2 @error('foto') border-red-500 @enderror">
        <p class="text-gray-500 text-sm mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
        @error('foto')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Status</label>
        <select name="status"
                class="w-full border rounded p-2 @error('status') border-red-500 @enderror">
            <option value="Tersedia" {{ old('status', $lapangan->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="Maintenance" {{ old('status', $lapangan->status) == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
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

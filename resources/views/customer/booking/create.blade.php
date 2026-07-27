@extends('layouts.customer')

@section('title', 'Booking Lapangan')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow p-6">

            <h2 class="text-2xl font-bold mb-6">Booking Lapangan</h2>

            <form action="{{ route('booking.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium mb-1">Lapangan</label>
                    <select name="lapangan_id" id="lapangan_id"
                            class="w-full border rounded p-2 @error('lapangan_id') border-red-500 @enderror">
                        <option value="">-- Pilih Lapangan --</option>
                        @foreach($lapangans as $l)
                            <option value="{{ $l->id }}"
                                    data-harga="{{ $l->harga_per_jam }}"
                                    {{ old('lapangan_id', $lapangan?->id) == $l->id ? 'selected' : '' }}>
                                {{ $l->nama }} ({{ $l->jenis }}) - Rp {{ number_format($l->harga_per_jam, 0, ',', '.') }}/jam
                            </option>
                        @endforeach
                    </select>
                    @error('lapangan_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                           class="w-full border rounded p-2 @error('tanggal') border-red-500 @enderror">
                    @error('tanggal')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}"
                               class="w-full border rounded p-2 @error('jam_mulai') border-red-500 @enderror">
                        @error('jam_mulai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai') }}"
                               class="w-full border rounded p-2 @error('jam_selesai') border-red-500 @enderror">
                        @error('jam_selesai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div id="totalContainer" class="mb-6 p-4 bg-gray-50 rounded hidden">
                    <p class="text-sm text-gray-600">Total Harga</p>
                    <p id="totalHarga" class="text-2xl font-bold text-blue-600">Rp 0</p>
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                    Booking Sekarang
                </button>

            </form>

        </div>
    </div>
</div>

@push('scripts')
<script>
    const lapanganSelect = document.getElementById('lapangan_id');
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');
    const totalContainer = document.getElementById('totalContainer');
    const totalHarga = document.getElementById('totalHarga');

    function hitungTotal() {
        const selected = lapanganSelect.options[lapanganSelect.selectedIndex];
        const hargaPerJam = selected ? parseInt(selected.dataset.harga) : 0;
        const mulai = jamMulai.value;
        const selesai = jamSelesai.value;

        if (hargaPerJam && mulai && selesai) {
            const [h1, m1] = mulai.split(':').map(Number);
            const [h2, m2] = selesai.split(':').map(Number);
            const durasi = (h2 * 60 + m2 - h1 * 60 - m1) / 60;
            if (durasi > 0) {
                const total = hargaPerJam * durasi;
                totalHarga.textContent = 'Rp ' + total.toLocaleString('id-ID');
                totalContainer.classList.remove('hidden');
                return;
            }
        }
        totalContainer.classList.add('hidden');
    }

    lapanganSelect.addEventListener('change', hitungTotal);
    jamMulai.addEventListener('change', hitungTotal);
    jamSelesai.addEventListener('change', hitungTotal);
</script>
@endpush
@endsection

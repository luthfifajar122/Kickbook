@extends('layouts.customer')

@section('title', 'Booking Lapangan')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if($lapangan)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="md:flex">
                @if($lapangan->foto)
                    <img src="{{ asset('storage/' . $lapangan->foto) }}" alt="{{ $lapangan->nama }}"
                         class="md:w-96 aspect-[16/10] md:aspect-auto md:h-64 object-cover">
                @else
                    <div class="md:w-96 h-56 md:h-64 bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center text-white/70">
                        <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
                <div class="p-6 flex flex-col justify-center">
                    <h2 class="text-3xl font-bold">{{ $lapangan->nama }}</h2>
                    <p class="text-gray-500 mt-1">{{ $lapangan->jenis }}</p>
                    <p class="text-3xl font-bold text-blue-600 mt-3">
                        Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                        <span class="text-base font-normal text-gray-500">/jam</span>
                    </p>
                </div>
            </div>
        </div>
        @else
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold">Booking Lapangan</h2>
            <p class="text-gray-500 mt-2">Pilih lapangan yang tersedia</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @foreach($lapangans as $l)
            <div class="lapangan-card bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition cursor-pointer border-2 {{ old('lapangan_id', $lapangan?->id) == $l->id ? 'border-blue-500' : 'border-transparent' }}"
                 data-id="{{ $l->id }}" data-harga="{{ $l->harga_per_jam }}">
                @if($l->foto)
                    <img src="{{ asset('storage/' . $l->foto) }}" alt="{{ $l->nama }}"
                         class="w-full aspect-[16/10] object-cover">
                @else
                    <div class="w-full aspect-[16/10] bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center text-white/70"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                @endif
                <div class="p-4">
                    <h3 class="font-bold text-lg">{{ $l->nama }}</h3>
                    <p class="text-gray-500 text-sm">{{ $l->jenis }}</p>
                    <p class="text-xl font-bold text-blue-600 mt-2">Rp {{ number_format($l->harga_per_jam, 0, ',', '.') }}<span class="text-sm font-normal text-gray-500">/jam</span></p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf

                <input type="hidden" name="lapangan_id" id="lapangan_id" value="{{ old('lapangan_id', $lapangan?->id) }}">

                @error('lapangan_id')
                    <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                @enderror

                <div class="grid sm:grid-cols-3 gap-4">
                    <div class="mb-1">
                        <label class="label">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                               class="input @error('tanggal') !border-red-500 @enderror">
                        @error('tanggal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label class="label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}"
                               class="input @error('jam_mulai') !border-red-500 @enderror">
                        @error('jam_mulai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label class="label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai') }}"
                               class="input @error('jam_selesai') !border-red-500 @enderror">
                        @error('jam_selesai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div id="totalContainer" class="mb-6 p-4 bg-blue-50/70 rounded-xl border border-blue-100 hidden">
                    <p class="text-sm text-gray-600">Total Harga</p>
                    <p id="totalHarga" class="text-3xl font-bold text-blue-600">Rp 0</p>
                </div>

                <button type="submit"
                        class="btn-primary w-full !py-3">
                    Booking Sekarang
                </button>

            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    const hargaPerJam = {{ $lapangan?->harga_per_jam ?? 0 }};
    let selectedHarga = hargaPerJam;
    const lapanganInput = document.getElementById('lapangan_id');
    const cards = document.querySelectorAll('.lapangan-card');
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');
    const totalContainer = document.getElementById('totalContainer');
    const totalHarga = document.getElementById('totalHarga');

    cards.forEach(card => {
        card.addEventListener('click', function() {
            cards.forEach(c => c.classList.remove('border-blue-500', 'border-2'));
            cards.forEach(c => c.classList.add('border-transparent'));
            this.classList.remove('border-transparent');
            this.classList.add('border-blue-500', 'border-2');
            lapanganInput.value = this.dataset.id;
            selectedHarga = parseInt(this.dataset.harga);
            hitungTotal();
        });
    });

    function hitungTotal() {
        const harga = selectedHarga || hargaPerJam;
        const mulai = jamMulai.value;
        const selesai = jamSelesai.value;

        if (harga && mulai && selesai && (lapanganInput.value || hargaPerJam)) {
            const [h1, m1] = mulai.split(':').map(Number);
            const [h2, m2] = selesai.split(':').map(Number);
            const durasi = (h2 * 60 + m2 - h1 * 60 - m1) / 60;
            if (durasi > 0) {
                const total = harga * durasi;
                totalHarga.textContent = 'Rp ' + total.toLocaleString('id-ID');
                totalContainer.classList.remove('hidden');
                return;
            }
        }
        totalContainer.classList.add('hidden');
    }

    jamMulai.addEventListener('change', hitungTotal);
    jamSelesai.addEventListener('change', hitungTotal);

    if (lapanganInput.value || hargaPerJam) hitungTotal();
</script>
@endpush
@endsection

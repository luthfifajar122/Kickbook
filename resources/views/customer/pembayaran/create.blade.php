@extends('layouts.customer')

@section('title', 'Pembayaran')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

        <a href="{{ route('booking.show', $booking->id) }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Kembali</a>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-6">Pembayaran</h2>

            <div class="bg-gray-50 rounded p-4 mb-6">
                <p class="text-sm text-gray-600">{{ $booking->lapangan->nama }} - {{ \Carbon\Carbon::parse($booking->tanggal)->isoFormat('D MMM Y') }} ({{ $booking->jam_mulai }} - {{ $booking->jam_selesai }})</p>
                <p class="text-2xl font-bold text-blue-600 mt-1">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
            </div>

            <form action="{{ route('pembayaran.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium mb-1">Metode Pembayaran</label>
                    <select name="metode" class="w-full border rounded p-2 @error('metode') border-red-500 @enderror">
                        <option value="transfer" {{ old('metode') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="tunai" {{ old('metode') == 'tunai' ? 'selected' : '' }}>Tunai (Bayar di Tempat)</option>
                    </select>
                    @error('metode')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4" id="buktiUpload">
                    <label class="block font-medium mb-1">Upload Bukti Bayar</label>
                    <input type="file" name="bukti_bayar" class="w-full border rounded p-2 @error('bukti_bayar') border-red-500 @enderror">
                    <p class="text-gray-500 text-sm mt-1">Kosongkan jika bayar tunai.</p>
                    @error('bukti_bayar')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                    Kirim Pembayaran
                </button>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    const metode = document.querySelector('select[name="metode"]');
    const bukti = document.getElementById('buktiUpload');
    metode.addEventListener('change', function() {
        bukti.style.display = this.value === 'tunai' ? 'none' : 'block';
    });
    if (metode.value === 'tunai') bukti.style.display = 'none';
</script>
@endpush
@endsection

@extends('layouts.customer')

@section('title', 'Beri Ulasan')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

        <a href="{{ route('booking.show', $booking->id) }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Kembali</a>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-2">Beri Ulasan</h2>
            <p class="text-gray-500 mb-6">{{ $booking->lapangan->nama }} - {{ \Carbon\Carbon::parse($booking->tanggal)->isoFormat('D MMM Y') }}</p>

            <form action="{{ route('ulasan.store', $booking->id) }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block font-medium mb-2">Rating</label>
                    <div class="flex gap-2" id="starRating">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" data-value="{{ $i }}"
                                    class="star text-3xl {{ old('rating') >= $i ? 'text-yellow-400' : 'text-gray-300' }}">★</button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating') }}">
                    @error('rating')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-6">
                    <label class="block font-medium mb-1">Komentar (opsional)</label>
                    <textarea name="komentar" rows="4"
                              class="w-full border rounded p-2 @error('komentar') border-red-500 @enderror">{{ old('komentar') }}</textarea>
                    @error('komentar')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                    Kirim Ulasan
                </button>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingInput');
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const val = parseInt(this.dataset.value);
            ratingInput.value = val;
            stars.forEach((s, i) => {
                s.classList.toggle('text-yellow-400', i < val);
                s.classList.toggle('text-gray-300', i >= val);
            });
        });
    });
</script>
@endpush
@endsection

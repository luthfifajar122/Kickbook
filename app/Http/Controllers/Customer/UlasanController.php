<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Ulasan;

class UlasanController extends Controller
{
    public function create(string $bookingId)
    {
        $booking = Booking::with('lapangan')
            ->where('user_id', auth()->id())
            ->where('status', 'Selesai')
            ->whereDoesntHave('ulasan')
            ->findOrFail($bookingId);

        return view('customer.ulasan.create', compact('booking'));
    }

    public function store(Request $request, string $bookingId)
    {
        $booking = Booking::with('lapangan')
            ->where('user_id', auth()->id())
            ->where('status', 'Selesai')
            ->whereDoesntHave('ulasan')
            ->findOrFail($bookingId);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        Ulasan::create([
            'booking_id' => $booking->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('booking.show', $booking->id)
            ->with('success', 'Ulasan berhasil dikirim. Terima kasih!');
    }
}

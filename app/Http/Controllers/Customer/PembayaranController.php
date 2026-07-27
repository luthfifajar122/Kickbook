<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function create(string $bookingId)
    {
        $booking = Booking::with('lapangan')
            ->where('user_id', auth()->id())
            ->where('status', 'Pending')
            ->findOrFail($bookingId);

        return view('customer.pembayaran.create', compact('booking'));
    }

    public function store(Request $request, string $bookingId)
    {
        $booking = Booking::with('lapangan')
            ->where('user_id', auth()->id())
            ->where('status', 'Pending')
            ->findOrFail($bookingId);

        $request->validate([
            'metode' => 'required|in:transfer,tunai',
            'bukti_bayar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $bukti = null;
        if ($request->hasFile('bukti_bayar')) {
            $bukti = $request->file('bukti_bayar')->store('pembayaran', 'public');
        }

        Pembayaran::create([
            'booking_id' => $booking->id,
            'metode' => $request->metode,
            'bukti_bayar' => $bukti,
            'total_bayar' => $booking->total_harga,
            'status' => 'Pending',
        ]);

        return redirect()->route('booking.show', $booking->id)
            ->with('success', 'Pembayaran berhasil dikirim. Silakan tunggu verifikasi admin.');
    }
}

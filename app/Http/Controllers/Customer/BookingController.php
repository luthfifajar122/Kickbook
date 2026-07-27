<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['lapangan', 'pembayaran'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('customer.booking.index', compact('bookings'));
    }

    public function create(?Lapangan $lapangan = null)
    {
        $lapangans = Lapangan::where('status', 'Tersedia')->get();

        return view('customer.booking.create', compact('lapangans', 'lapangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $lapangan = Lapangan::findOrFail($request->lapangan_id);
        $jamMulai = \Carbon\Carbon::parse($request->jam_mulai);
        $jamSelesai = \Carbon\Carbon::parse($request->jam_selesai);
        $durasi = $jamMulai->diffInHours($jamSelesai);
        $totalHarga = $lapangan->harga_per_jam * $durasi;

        Booking::create([
            'user_id' => auth()->id(),
            'lapangan_id' => $request->lapangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'total_harga' => $totalHarga,
            'status' => 'Pending',
        ]);

        return redirect()->route('booking.index')
            ->with('success', 'Booking berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function show(string $id)
    {
        $booking = Booking::with(['lapangan', 'pembayaran', 'ulasan'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('customer.booking.show', compact('booking'));
    }
}

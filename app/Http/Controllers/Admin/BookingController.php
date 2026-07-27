<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\User;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'lapangan', 'pembayaran'])->latest()->get();

        return view('admin.booking.index', compact('bookings'));
    }

    public function create()
    {
        $lapangans = Lapangan::where('status', 'Tersedia')->get();
        $customers = User::where('role', 'customer')->get();

        return view('admin.booking.create', compact('lapangans', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
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
            'user_id' => $request->user_id,
            'lapangan_id' => $request->lapangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'total_harga' => $totalHarga,
            'status' => 'Pending',
        ]);

        return redirect()->route('admin.booking.index')
            ->with('success', 'Booking berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $booking = Booking::with(['user', 'lapangan', 'pembayaran', 'ulasan.user'])->findOrFail($id);

        return view('admin.booking.show', compact('booking'));
    }

    public function update(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Pending,Dibayar,Selesai,Dibatalkan',
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()->route('admin.booking.index')
            ->with('success', 'Status booking berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.booking.index')
            ->with('success', 'Booking berhasil dihapus.');
    }
}

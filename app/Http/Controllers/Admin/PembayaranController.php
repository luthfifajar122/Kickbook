<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Booking;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('booking.user', 'booking.lapangan')->latest()->get();

        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    public function show(string $id)
    {
        $pembayaran = Pembayaran::with('booking.user', 'booking.lapangan')->findOrFail($id);

        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:Diverifikasi,Gagal',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status' => $request->status]);

        if ($request->status === 'Diverifikasi') {
            $pembayaran->booking->update(['status' => 'Dibayar']);
        }

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if ($pembayaran->bukti_bayar) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($pembayaran->bukti_bayar);
        }

        $pembayaran->delete();

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}

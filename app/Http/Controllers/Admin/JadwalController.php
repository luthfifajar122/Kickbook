<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Lapangan;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('lapangan')->latest()->get();

        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $lapangans = Lapangan::where('status', 'Tersedia')->get();

        return view('admin.jadwal.create', compact('lapangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|in:Tersedia,Tidak Tersedia',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $lapangans = Lapangan::where('status', 'Tersedia')->get();

        return view('admin.jadwal.edit', compact('jadwal', 'lapangans'));
    }

    public function update(Request $request, string $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|in:Tersedia,Tidak Tersedia',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}

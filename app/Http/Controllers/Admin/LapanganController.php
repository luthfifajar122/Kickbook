<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Lapangan;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lapangans = Lapangan::all();

            return view('admin.lapangan.index',compact('lapangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lapangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=> 'required',
            'jenis' => 'required',
            'harga_per_jam' => 'required|numeric',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $foto = null;

        if ($request->hasFile('foto')){
            $foto = $request->file('foto')->store('lapangan','public');
        }
        Lapangan::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'harga_per_jam' => $request->harga_per_jam,
            'status' => $request->status,
            'foto' => $foto,
        ]);

        return redirect()->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        return view('admin.lapangan.edit', compact('lapangan'));
    }

    public function update(Request $request, string $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        $request->validate([
            'nama'=> 'required',
            'jenis' => 'required',
            'harga_per_jam' => 'required|numeric',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'harga_per_jam' => $request->harga_per_jam,
            'status' => $request->status,
        ];

        if ($request->hasFile('foto')) {
            if ($lapangan->foto) {
                Storage::disk('public')->delete($lapangan->foto);
            }

            $data['foto'] = $request->file('foto')->store('lapangan', 'public');
        }

        $lapangan->update($data);

        return redirect()->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        if ($lapangan->foto) {
            Storage::disk('public')->delete($lapangan->foto);
        }

        $lapangan->delete();

        return redirect()->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil dihapus.');
    }
}

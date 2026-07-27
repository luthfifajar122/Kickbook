<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::where('status', 'Tersedia')->get();

        return view('customer.lapangan.index', compact('lapangans'));
    }
}

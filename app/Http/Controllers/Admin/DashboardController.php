<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Booking;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLapangan = Lapangan::count();
        $totalBooking = Booking::count();
        $totalCustomer = User::where('role', 'customer')->count();
        $bookingHariIni = Booking::whereDate('created_at', today())->count();

        return view('admin.dashboard', compact(
            'totalLapangan',
            'totalBooking',
            'totalCustomer',
            'bookingHariIni'
        ));
    }
}

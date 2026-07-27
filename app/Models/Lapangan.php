<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $fillable = [
        'nama',
        'jenis',
        'harga_per_jam',
        'foto',
        'status',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

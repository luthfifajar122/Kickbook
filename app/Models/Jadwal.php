<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'lapangan_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }
}

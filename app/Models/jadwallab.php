<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLab extends Model
{
    use HasFactory;

    protected $table = 'jadwallabs'; // ← opsional, hanya jika nama tabel kamu lowercase
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_lab',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kegiatan',
        'dosen_pengampu',
    ];

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class, 'id_lab', 'id_lab');
    }
}

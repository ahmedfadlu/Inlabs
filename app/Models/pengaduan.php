<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pengaduan';
    protected $table = 'pengaduan';

    protected $fillable = [
        'id_user', 'id_lab', 'deskripsi','jenis_laporan',
        'foto_kerusakan', 'tanggal_lapor', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class, 'id_lab');
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatPengaduan::class, 'id_pengaduan');
    }
}

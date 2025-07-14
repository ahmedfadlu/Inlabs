<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_riwayat';
    protected $table = 'riwayatpengaduan';

    protected $fillable = [
        'id_pengaduan', 'status_lama', 'status_baru',
        'tanggal_update', 'diperbarui_oleh'
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan');
    }

    public function diperbaruiOleh()
    {
        return $this->belongsTo(User::class, 'diperbarui_oleh');
    }
}

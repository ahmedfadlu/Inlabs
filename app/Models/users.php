<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users'; // opsional, tapi disarankan eksplisit
    protected $primaryKey = 'id_user'; // perbaikan di sini
    protected $fillable = ['nama', 'email', 'nim', 'password', 'role'];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_user');
    }

    public function riwayatPengaduan()
    {
        return $this->hasMany(RiwayatPengaduan::class, 'diperbarui_oleh');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_lab'; // karena bukan id biasa
    protected $table = 'laboratorium'; // nama tabel (jangan jamak)

    protected $fillable = [
        'nama_lab',
        'lokasi',
        'kapasitas',
        'gambar_lab',
        'status',
    ];
}

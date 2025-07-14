<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventaris extends Model
{
 use HasFactory;

    protected $primaryKey = 'id_item';
    protected $fillable = ['nama_item', 'jumlah', 'kondisi', 'id_lab'];

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class, 'id_lab');
    }
}
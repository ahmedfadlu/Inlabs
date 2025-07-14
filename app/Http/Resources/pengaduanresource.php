<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengaduanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_pengaduan' => $this->id_pengaduan,
            'id_user' => $this->id_user,
            'id_lab' => $this->id_lab,
            'deskripsi' => $this->deskripsi,
            'foto_kerusakan' => $this->foto_kerusakan,
            'tanggal_lapor' => $this->tanggal_lapor,
            'status' => $this->status,
        ];
    }
}

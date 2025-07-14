<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RiwayatPengaduanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_riwayat' => $this->id_riwayat,
            'id_pengaduan' => $this->id_pengaduan,
            'status_lama' => $this->status_lama,
            'status_baru' => $this->status_baru,
            'tanggal_update' => $this->tanggal_update,
            'diperbarui_oleh' => $this->diperbarui_oleh,
        ];
    }
}
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JadwalLabResource extends JsonResource
{
    // app/Http/Resources/JadwalLabResource.php

public function toArray($request)
{
    return [
        'id_jadwal' => $this->id_jadwal,
        'hari' => $this->hari,
        'jam_mulai' => $this->jam_mulai,
        'jam_selesai' => $this->jam_selesai,
        'kegiatan' => $this->kegiatan,
        'dosen_pengampu' => $this->dosen_pengampu,
        'laboratorium' => [
            'id_lab' => $this->laboratorium->id_lab ?? null,
            'nama_lab' => $this->laboratorium->nama_lab ?? '-',
        ]
    ];
}
}

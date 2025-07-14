<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratoriumResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_lab' => $this->id_lab,
            'nama_lab' => $this->nama_lab,
            'lokasi' => $this->lokasi,
            'kapasitas' => $this->kapasitas,
            'gambar_lab' => $this->gambar_lab,
            'status' => $this->status,
        ];
    }
}
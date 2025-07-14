<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventarisResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_item' => $this->id_item,
            'nama_item' => $this->nama_item,
            'jumlah' => $this->jumlah,
            'kondisi' => $this->kondisi,
            'id_lab' => $this->id_lab,
        ];
    }
}

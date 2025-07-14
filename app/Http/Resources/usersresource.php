<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_user' => $this->id_user,
            'nama' => $this->nama,
            'email' => $this->email,
            'nim' => $this->nim,
            'role' => $this->role,
        ];
    }
}

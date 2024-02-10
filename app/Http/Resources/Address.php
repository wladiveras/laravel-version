<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'city_id' => $this->city_id,
            'number' => (int) $this->number,
            'street' => $this->street,
            'neighboorhood' => $this->neighboorhood,
            'country' => $this->country,
            'complement' => $this->complement,
            'city' => $this->city
        ];
    }
}

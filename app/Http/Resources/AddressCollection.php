<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
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

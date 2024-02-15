<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\State;

class City extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'state_code' => $this->state_code,
            'is_capital' => $this->is_capital,
            'state' => new State($this->state),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Stove extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'burners' => $this->burners,
            'lighters' => $this->lighters,
            'lamp_button' => $this->lamp_button,
            'lighters_colors' => unserialize($this->lighters_colors),
            'oven' => $this->oven,
            'oven_lamp' => $this->oven_lamp,
            'oven_lamp_color' => $this->oven_lamp_color,
            'oven_color' => $this->oven_color,
            'stove_color' => $this->stove_color,
            'stove_width' => $this->stove_width,
            'stove_height' => $this->stove_height,
            'stove_depth' => $this->stove_depth,
            'glass_width' => $this->glass_width,
            'glass_height' => $this->glass_height,
            'glass_lenght' => $this->glass_lenght,
            'brand' => $this->brand
        ];
    }
}

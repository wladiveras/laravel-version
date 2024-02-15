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
            'name' => $this->name,
            'burners' => $this->burners,
            'lighters' => $this->lighters,
            'lighters_colors' => $this->lighters_colors,
            'oven' => $this->oven,
            'oven_lamp' => $this->oven_lamp,
            'oven_lamp_color' => $this->oven_lamp_color,
            'oven_color' => $this->oven_color,
            'stove_color' => $this->stove_color,
            'stove_width' => $this->stove_width,
            'stove_heigh' => $this->stove_heigh,
            'stove_depth' => $this->stove_depth,
            'glass_width' => $this->glass_width,
            'glass_heigth' => $this->glass_heigth,
            'glass_length' => $this->glass_length,
            'brand' => $this->brand
        ];
    }
}

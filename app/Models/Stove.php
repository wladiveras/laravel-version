<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stove extends Model
{
    use HasFactory;

    protected $fillable = [
        'burners',
        'lighters',
        'lighters_colors',
        'oven',
        'oven_lamp',
        'oven_lamp_color',
        'oven_color',
        'stove_color',
        'stove_width',
        'stove_heigh',
        'stove_depth',
        'glass_width',
        'glass_heigth',
        'glass_length',
        'brand',
    ];
}

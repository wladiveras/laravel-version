<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stove;

class StoveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stove::truncate();

        Stove::create([
            'burners' => 4,

            'lighters' => 5,
            'lighters_colors' => serialize(['#924A3B', '#3FB45F', '#1C5B2D', '#71527C', '#390318 ']),

            'lamp_button' => 1,

            'oven' => 1,
            'oven_lamp' => 1,
            
            'oven_lamp_color' => '#CFDC34',
            'oven_color' => '#fff',
            
            'stove_color' => '#fff',
            'stove_width' => 45,
            'stove_height' => 45,
            'stove_depth' => 50,

            'glass_width' => 30,
            'glass_height' => 35,
            'glass_lenght' => 45,

            'brand' => 'samsung'
        ]);

        Stove::create([
            'burners' => 5,

            'lighters' => 5,
            'lighters_colors' => serialize(['#924A3B', '#6D7325', '#1DF1E5', '#44D2C9', '#2B6F6B']),
            
            'lamp_button' => 1,
            
            'oven' => 1,
            'oven_lamp' => 1,
            
            'oven_lamp_color' => '#6D7325',
            'oven_color' => '#000',

            'stove_color' => '#000',
            'stove_width' => 65,
            'stove_height' => 60,
            'stove_depth' => 70,

            'glass_width' => 40,
            'glass_height' => 50,
            'glass_lenght' => 60,

            'brand' => 'apple'
        ]);
    }
}

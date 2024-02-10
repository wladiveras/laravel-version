<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::truncate();

        $json = File::get("database/data/brazil.json");
        $countries = json_decode($json);

        foreach ($countries->states as $key => $value) {
            State::create([
                "name" => $value->state,
                "code" => $value->id
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\City;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        City::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $json = File::get("database/data/brazil.json");
        $countries = json_decode($json);

        foreach ($countries->cities as $key => $value) {
            City::create([
                "name" => $value->city,
                "state_code" => $value->stateId,
                "is_capital" => isset($value->capital) ? true : false,
            ]);
        }
    }
}

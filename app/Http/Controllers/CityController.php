<?php

namespace App\Http\Controllers;

use App\Http\Resources\City as CityResource;
use App\Http\Resources\CityCollection;
use App\Models\City;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::with('state')->get();

        if (!$cities) {
            return parseResponse(
                errors: ["message" => "cannot retrieve cities."],
                code: 404,
            );
        }

        $cities = new CityCollection($cities);

        return parseResponse(
            result: $cities,
            action: true,
        );
    }

    public function show(string $id)
    {
        $city = City::with('state')->where('id', $id);

        if (!$city->exists()) {
            return parseResponse(
                errors: ["message" => "cannot find this city, try a different id."],
                code: 404,
            );
        }

        $city = $city->first();
        $city = new CityResource($city);

        return parseResponse(
            result: $city,
            action: true,
        );
    }
}

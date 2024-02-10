<?php

namespace App\Http\Controllers;

use App\Http\Resources\State as StateResource;
use App\Http\Resources\StateCollection;
use App\Models\State;

class StateController extends Controller
{

    public function index()
    {
        $state = State::all();

        if (!$state) {
            return parseResponse(
                errors: ["message" => "cannot retrieve states."],
                code: 404,
            );
        }

        $state = new StateCollection($state);

        return parseResponse(
            result: $state,
            action: true,
        );
    }

    public function show(string $code)
    {

        $state = State::where('code', $code);

        if (!$state->exists()) {
            return parseResponse(
                errors: ["message" => "cannot find this states, try a different code."],
                code: 404,
            );
        }

        $state = $state->first();
        $state = new StateResource($state);

        return parseResponse(
            result: $state,
            action: true,
        );
    }
}

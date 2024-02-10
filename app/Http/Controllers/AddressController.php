<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressCollection;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function show(int $id)
    {

        $user = Address::with('city', 'city.state')->where('id', $id);

        if ($user->exists()) {
            $user = $user->first();
            $user = new AddressCollection($user);

            return parseResponse(
                result: $user,
                action: true,
            );
        }

        return parseResponse(
            errors: ["message" => "cannot find this user, try a different id."],
            code: 404,
        );
    }
    public function create(Request $request)
    {
    }
    public function update(int $id, Request $request)
    {
    }

    public function delete(int $id)
    {
    }
}

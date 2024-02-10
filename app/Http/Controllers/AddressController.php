<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressCollection;
use App\Http\Resources\Address as AddressResource;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::with('city', 'city.state')->get();

        if (!$addresses) {
            return parseResponse(
                errors: ["message" => "cannot retrieve adresses."],
                code: 404,
            );
        }

        $address = new AddressCollection($addresses);

        return parseResponse(
            result: $address,
            action: true,
        );
    }
    public function show(int $id)
    {
        $address = Address::with('city', 'city.state')->where('id', $id);

        if (!$address->exists()) {
            return parseResponse(
                errors: ["message" => "cannot find this address, try a different id."],
                code: 404,
            );
        }

        $address = $address->first();
        $address = new AddressResource($address);

        return parseResponse(
            result: $address,
            action: true,
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'city_id' => 'required|integer',
            'number' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'neighbourhood' => 'required|string|max:255',
            'complement' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $createdAddress = Address::create($request->validated());

        if (!$createdAddress) {
            return parseResponse(
                errors: ["message" => "cannot create a new address."],
                code: 404,
            );
        }

        return parseResponse(
            result: $createdAddress,
            action: true,
        );
    }


    public function update(int $id, Request $request)
    {
        $request->validate([
            'city_id' => 'integer',
            'number' => 'string|max:100',
            'street' => 'string|max:100',
            'neighbourhood' => 'string|max:255',
            'complement' => 'string|max:255',
            'country' => 'string|max:50',
        ]);

        $address = Address::with('city', 'city.state')->where('id', $id);

        if (!$address->exists()) {
            return parseResponse(
                errors: ["message" => "cannot find this address, try a different id."],
                code: 404,
            );
        }

        $updateAddress = $address->update($request->validated());

        if (!$updateAddress) {
            return parseResponse(
                errors: ["message" => "cannot update address, try again later."],
                code: 404,
            );
        }

        $address = $address->first();
        $address = new AddressCollection($address);

        return parseResponse(
            result: $address,
            action: true,
        );
    }

    public function destroy(int $id)
    {
        $address = Address::where('id', $id);

        if (!$address->exists()) {
            return parseResponse(
                errors: ["message" => "cannot delete this address, try a different id."],
                code: 404,
            );
        }

        return parseResponse(
            result: $id,
            action: true,
        );
    }
}

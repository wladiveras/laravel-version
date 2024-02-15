<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressCollection;
use App\Http\Resources\Address as AddressResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function index(): JsonResponse
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

    public function show(int $id): JsonResponse
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

    public function update(int $id, Request $request): JsonResponse
    {

        try {
            $validated = $request->validate([
                'city_id' => 'required|integer',
                'number' => 'required|max:50',
                'street' => 'required|string|max:255',
                'neighbourhood' => 'required|string|max:255',
                'country' => 'required|string|min:3|max:50',
                'complement' => 'string|min:5|max:255',
                'postal_code' => 'required|string|min:5|max:255',
            ]);
        } catch (ValidationException $e) {
            return parseResponse(
                errors: ["message" => $e->errors()],
                code: 404,
            );
        }

        $address = Address::with('city', 'city.state')->where('id', $id);

        if (!$address->exists()) {
            return parseResponse(
                errors: ["message" => "cannot find this user, try a different id."],
                code: 404,
            );
        }

        $updateAddress = $address->update($validated);

        if (!$updateAddress) {
            return parseResponse(
                errors: ["message" => "cannot find this address, try a different id."],
                code: 404,
            );
        }

        $address = $address->with('city', 'city.state')->first();
        $address = new AddressResource($address);

        return parseResponse(
            result: $address,
            action: true,
        );
    }
}

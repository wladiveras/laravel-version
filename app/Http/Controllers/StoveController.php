<?php

namespace App\Http\Controllers;

use App\Http\Resources\Stove as StoveResource;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\StoveCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Stove;

class StoveController extends Controller
{
    public function index(): JsonResponse
    {
        $stove = Stove::all();

        if (!$stove) {
            return parseResponse(
                errors: ["message" => "cannot retrieve stoves."],
                code: 404,
            );
        }

        $stove = new StoveCollection($stove);

        return parseResponse(
            result: $stove,
            action: true,
        );
    }

    public function show(string $code): JsonResponse
    {
        $stove = Stove::where('code', $code);

        if (!$stove->exists()) {
            return parseResponse(
                errors: ["message" => "cannot find this stove, try a different code."],
                code: 404,
            );
        }

        $stove = $stove->first();
        $stove = new StoveResource($stove);

        return parseResponse(
            result: $stove,
            action: true,
        );
    }

    public function store(Request $request): JsonResponse
    {

        try {
            $validated = $request->validate([
                'burners' => 'required|integer|min:4|max:10',
                'lighters' => 'required|integer|min:4|max:10',
                'oven' => 'required|integer|min:1|max:2',
                'oven_lamp' => 'required|integer|min:1|max:10',
                'lighters_colors' => 'required|min:4|max:10',
                'oven_lamp_color' => 'required|max:255',
                'oven_color' => 'required|max:255',
                'stove_color' => 'required|max:255',
                'stove_width' => 'required|max:255',
                'stove_heigh' => 'required|max:255',
                'stove_depth' => 'required|max:255',
                'glass_width' => 'required|max:255',
                'glass_heigth' => 'required|max:255',
                'glass_length' => 'required|max:255',
                'brand' => 'required|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return parseResponse(
                errors: ["message" => $e->errors()],
                code: 404,
            );
        }

        $createStove = Stove::create($validated);

        if (!$createStove) {
            return parseResponse(
                errors: ["message" => "cannot create a new user."],
                code: 404,
            );
        }

        $stove = Stove::findOrFail($createStove->id);

        return parseResponse(
            result: new StoveResource($stove),
            action: true,
        );
    }

    public function update(int $id, Request $request): JsonResponse
    {

        try {
            $validated = $request->validate([
                'burners' => 'integer|min:4|max:10',
                'lighters' => 'integer|min:4|max:10',
                'oven' => 'integer|min:1|max:2',
                'oven_lamp' => 'integer|min:1|max:10',
                'lighters_colors' => 'min:4|max:10',
                'oven_lamp_color' => 'max:255',
                'oven_color' => 'max:255',
                'stove_color' => 'max:255',
                'stove_width' => 'max:255',
                'stove_heigh' => 'max:255',
                'stove_depth' => 'max:255',
                'glass_width' => 'max:255',
                'glass_heigth' => 'max:255',
                'glass_length' => 'max:255',
                'brand' => 'string|max:255',
            ]);
        } catch (ValidationException $e) {
            return parseResponse(
                errors: ["message" => $e->errors()],
                code: 404,
            );
        }

        $stove = Stove::where('id', $id);

        if (!$stove->exists()) {
            return parseResponse(
                errors: ["message" => "cannot find this stove, try a different id."],
                code: 404,
            );
        }

        $updateStove = $stove->update($validated);

        if (!$updateStove) {
            return parseResponse(
                errors: ["message" => "cannot find this stove, try a different id."],
                code: 404,
            );
        }

        $stove = $stove->first();
        $stove = new StoveCollection($stove);

        return parseResponse(
            result: $stove,
            action: true,
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $stove = Stove::where('id', $id);

        if (!$stove->exists()) {
            return parseResponse(
                errors: ["message" => "connot find this stove."],
                code: 404,
            );
        }

        $stove->delete();

        return parseResponse(
            result: $id,
            action: true,
        );
    }
}

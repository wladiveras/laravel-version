<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Arr;
use App\Models\User;


class UserController extends Controller
{

    public function index(): JsonResponse
    {
        $users = User::with('address')->get();

        if (!$users) {
            return parseResponse(
                errors: ["message" => "cannot retrieve users."],
                code: 404,
            );
        }

        $users = new UserCollection($users);

        return parseResponse(
            result: $users,
            action: true,
        );
    }

    public function show(int $id): JsonResponse
    {
        $user = User::with('address')->where('id', $id);

        if (!$user->exists()) {
            return parseResponse(
                errors: ["message" => "cannot find this user, try a different id."],
                code: 404,
            );
        }

        $user = $user->first();
        $user = new UserResource($user);

        return parseResponse(
            result: $user,
            action: true,
        );
    }

    public function auth(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
            ]);
        } catch (ValidationException $e) {
            return parseResponse(
                errors: ["message" => $e->errors()],
                code: 404,
            );
        }

        $user = User::with('address')->where('email', $request->input('email'));

        if (!$user->exists()) {
            return parseResponse(
                errors: ["message" => "Connot sign in with this email"],
                code: 401,
            );
        }

        $user = $user->first();
        $user = new UserResource($user);

        return parseResponse(
            result: $user,
            action: true,
        );
    }

    public function store(Request $request): JsonResponse
    {

        try {
            $validated = $request->validate([
                'name' => 'required|min:5|max:50',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|max:255',
                'address' => 'required|array',
                'address.city_id' => 'required|integer',
                'address.number' => 'required|max:50',
                'address.street' => 'required|string|max:255',
                'address.neighbourhood' => 'required|string|max:255',
                'address.country' => 'required|string|min:3|max:50',
                'address.complement' => '',
                'address.postal_code' => 'required|string|min:5|max:255',
            ]);
        } catch (ValidationException $e) {
            return parseResponse(
                errors: ["message" => $e->errors()],
                code: 404,
            );
        }

        $createUser = User::create(Arr::except($validated, ['price']));

        if (!$createUser) {
            return parseResponse(
                errors: ["message" => "cannot create a new user."],
                code: 404,
            );
        }

        $createAddress = $createUser->address()->create($validated['address']);

        if (!$createAddress) {
            return parseResponse(
                errors: ["message" => "cannot create address to new user."],
                code: 404,
            );
        }

        $user = User::with('address')->findOrFail($createUser->id);

        return parseResponse(
            result: new UserResource($user),
            action: true,
        );
    }

    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'min:5|max:50',
                'email' => 'email|unique:users',
                'password' => 'min:8|max:255',
            ]);
        } catch (ValidationException $e) {
            return parseResponse(
                errors: ["message" => $e->errors()],
                code: 404,
            );
        }

        $user = User::with('address')->where('id', $id);

        if (!$user->exists()) {
            return parseResponse(
                errors: ["message" => "cannot find this user, try a different id."],
                code: 404,
            );
        }

        $updateUser = $user->update($validated);

        if (!$updateUser) {
            return parseResponse(
                errors: ["message" => "cannot update user, try again later."],
                code: 404,
            );
        }

        $user = $user->with('address')->first();
        $user = new UserResource($user);

        return parseResponse(
            result: $user,
            action: true,
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $user = User::where('id', $id);

        if (!$user->exists()) {
            return parseResponse(
                errors: ["message" => "connot find this user."],
                code: 404,
            );
        }

        $user->delete();

        return parseResponse(
            result: $id,
            action: true,
        );
    }
}

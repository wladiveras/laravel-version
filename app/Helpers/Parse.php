<?php

function parseResponse(mixed $result = [], bool $action = false, array $errors = ['generic' => 'something went wrong'], int $code = 200)
{
    $response = [
        'success' => $action,
        'errors' => $action ?  [] : $errors,
        'data' => $action ? $result : [],
    ];

    return response()->json($response, $code);
}

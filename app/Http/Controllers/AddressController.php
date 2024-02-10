<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function show(Request $request)
    {
        return Address::with('city', 'city.state')->findOrFail($request->id);
    }
}

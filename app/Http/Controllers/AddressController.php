<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        return Address::with('city', 'city.state')->find($request->id);
    }
}

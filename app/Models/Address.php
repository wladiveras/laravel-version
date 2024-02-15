<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city_id',
        'number',
        'street',
        'neighbourhood',
        'complement',
        'country',
        'postal_code'
    ];

    public function city(): belongsTo
    {
        return $this->belongsTo(City::class);
    }
}

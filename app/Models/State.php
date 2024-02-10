<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;


class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    public function city(): HasMany
    {
        return $this->hasMany(City::class, 'state_code', 'code');
    }
}

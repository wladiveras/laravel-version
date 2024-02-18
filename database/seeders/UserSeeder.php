<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();
        Address::truncate();

        Schema::enableForeignKeyConstraints();

        $createUser = User::create([
            'name' => 'Wladi Veras',
            'email' => 'test@email.com',
            'password' => 'secret',
        ]);

        $createUser->address()->create([
            'city_id'=> $createUser->id,
            'number'=> 31,
            'street'=> 'Rua da verdade',
            'neighbourhood'=> 'Guadalupe',
            'country'=> 'Brasil',
            'complement'=> 'Ao lado da casa 2',
            'postal_code'=> '21515-020'

        ]);

   
    }
}

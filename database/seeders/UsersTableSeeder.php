<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();

        User::create([
            'name' => 'lawrence',
            'email'=> 'lgallaty@gmail.com',
            'password' => Hash::make('diphita2022') 
        ]);
    }
}

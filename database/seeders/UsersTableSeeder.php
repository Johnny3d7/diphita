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
            'name' => 'Lawrence',
            'pnom' => 'GALLATY',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022') ,
            'image_name' => 'admins_profil/lawrence_gallaty'
        ]);

        User::create([
            'name' => 'Judith',
            'pnom' => 'N\'GUESSAN',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'admins_profil/nguessan_judith'
        ]);

        User::create([
            'name' => 'Bérenger',
            'pnom' => 'KOUASSI',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'admins_profil/kouassi_berenger'
        ]);

        User::create([
            'name' => 'Florentin',
            'pnom' => 'N\'GUESSAN',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'admins_profil/nguessan_florentin'
        ]);

        User::create([
            'name' => 'Alice',
            'pnom' => 'BLA',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'admins_profil/bla_alice'
        ]);

        User::create([
            'name' => 'Richard',
            'pnom' => 'LOLOU',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'client_img',
        ]);

        User::create([
            'name' => 'Narcisse',
            'pnom' => 'BOUAZO',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'admins_profil/bouazo_narcisse'
        ]);
    }
}

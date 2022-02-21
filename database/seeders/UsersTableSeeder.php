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
            'image_name' => 'admins_profil/lawrence_gallaty',
            'role' => 'super_admin',
            'contact' => '(+225) 01-41-68-30-29'
        ]);

        User::create([
            'name' => 'Judith',
            'pnom' => 'N\'GUESSAN',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'admins_profil/nguessan_judith',
            'role' => 'super_admin',
            'contact' => '(+225) 01-41-68-30-29'
        ]);

        User::create([
            'name' => 'Bérenger',
            'pnom' => 'KOUASSI',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'admins_profil/kouassi_berenger',
            'role' => 'admin',
            'contact' => '(+225) 01-41-68-30-29'
        ]);

        User::create([
            'name' => 'Florentin',
            'pnom' => 'N\'GUESSAN',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'admins_profil/nguessan_florentin',
            'role' => 'admin',
            'contact' => '(+225) 01-41-68-30-29'
        ]);

        User::create([
            'name' => 'Alice',
            'pnom' => 'BLA',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'admins_profil/bla_alice',
            'role' => 'admin',
            'contact' => '(+225) 01-41-68-30-29'
        ]);

        User::create([
            'name' => 'Richard',
            'pnom' => 'LOLOU',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'admins_profil/rich_lolou',
            'role' => 'admin_oume',
            'contact' => '(+225) 01-41-68-30-29'
        ]);

        User::create([
            'name' => 'Narcisse',
            'pnom' => 'BOUAZO',
            'email'=> 'sregis.ble@gmail.com',
            'password' => Hash::make('diphita2022'),
            'image_name' => 'admins_profil/bouazo_narcisse',
            'role' => 'admin_ouelle',
            'contact' => '(+225) 01-41-68-30-29'
        ]);
    }
}

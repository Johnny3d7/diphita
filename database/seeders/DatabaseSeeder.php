<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(UsersTableSeeder::class);
        $this->command->info('User table seeded!');

        $this->call(AdherentsTableSeeder::class);
        $this->command->info('Adherent table seeded!');

        $this->call(AyantsDroitTableSeeder::class);
        $this->command->info('AyantsDroit table seeded!');
    }
}

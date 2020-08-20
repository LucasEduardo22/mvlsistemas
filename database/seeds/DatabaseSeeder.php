<?php

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
        // $this->call(UserSeeder::class);
        App\User::create([
            'nome'         => 'Lucas G G Eduardo',
            'cpf'         => '12345678910',
            'email'     => 'lucas.e.2@hotmail.com',
            'password'     => bcrypt('12345678'),
            'status_id'     => '1',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'perfil_id' => 1,
            'name'  => 'Lucas',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'status_id' => 1,
        ]);
        $this->command->info('User account created with following details: admin@admin.com, password');
    }
}

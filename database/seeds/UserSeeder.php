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
            'cpf'           => '00114725636',
            'telefone'      => '41992357727',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'status_id' => 1,
            'endereco' => 'Rua Cid Gonçalves',
            'bairro' => 'Cidade Industrial',
            'cidade' => 'Curitiba',
            'estado' => 'parana',
            'cep' => '81240520',
            'numero' => '14',
            'complemento' => 'casa',
        ]);
    }
}

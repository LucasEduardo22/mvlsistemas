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
       
        User::create([
            'perfil_id' => 1,
            'name'  => 'Lucas',
            'cpf'           => '0011725636',
            'telefone'      => '4199357727',
            'email' => 'teste@admin.com',
            'password' => Hash::make('12345678'),
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

<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'perfil_id'   => 1,
            'nome'        => 'Lucas G G Eduardo',
            'cpf'         => '87779812006',
            'rg'          => '377829237',
            'celular'     => '4199513769',
            'email'       => 'lucas.e.2@hotmail.com',
            'password'    => bcrypt('12345678'),
            'status_id'   => '1',
            'cep'         => '83075500',
            'estado'      => 'Parana',
            'Cidade'      => 'São José dos Pinhais',
            'Bairro'      => 'Borda do Campo',
            'endereco'    => 'Rua Antonio Peniche de Moura',
            'numero'      => '598',
            'complemento'      => 'loja',

        ]);
    }
}

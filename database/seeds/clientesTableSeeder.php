<?php

use Illuminate\Database\Seeder;
use App\Cliente;

class clientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
        	'id' => 1,
            'nome' => 'Tete',
            'cpf' => '041245158',
            'telefone' => '991502142',
            'endereço' => 'Rua Almiranta'

        ]);
        Cliente::create([
        	'id' => 2,
            'nome' => 'Luicie',
            'cpf' => '0210410174',
            'telefone' => '291520147',
            'endereço' => 'Rua Barroso'
        ]);
        
    }
}




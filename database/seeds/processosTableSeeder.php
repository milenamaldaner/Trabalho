<?php

use Illuminate\Database\Seeder;
use App\Processo;

class processosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Processo::create([
        	'id' => 1,
            'nome' => 'Joao',
            'numero_processo' => '04101',
            'instancia' => '1',
            'vara' => 'Trabalho',
            'comarca' => 'Ibirubá',
            'descrição' => 'Penal'
            


        ]);
        Processo::create([
        	'id' => 2,
            'nome' => 'Joao',
            'numero_processo' => '04102',
            'instancia' => '1',
            'vara' => 'Trabalho',
            'comarca' => 'Ibirubá',
            'descrição' => 'Criminal'
        ]);
    }
}

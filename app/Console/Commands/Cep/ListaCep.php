<?php

namespace App\Console\Commands\Cep;

use App\Models\Estado;
use Illuminate\Console\Command;

class ListaCep extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lista:cep';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listando todos os cep';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /* $estados = Estado::all();

        foreach($estados as $estado){
            dump($estado->uf);
        } */
        $opts = [
            "http" => [
                //"method" => "GET",
                "header" => "Accept: application/json"
            ]
        ];
        
        $context = stream_context_create($opts);
        // -H"Accept: text/plain" 
        $file = file_get_contents('http://cep.la/api/SP', false, $context);
        dump($file);
        return;
    }
}

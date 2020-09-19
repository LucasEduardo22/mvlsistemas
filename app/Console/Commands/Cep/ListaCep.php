<?php

namespace App\Console\Commands\Cep;

use App\Models\Bairro;
use App\Models\Cidade;
use App\Models\Estado;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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
        $this->cidade();
        //$this->bairro();
        

        
    }

    public function cidade(){
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json"
            ]
        ];
        
        $context = stream_context_create($opts); 
        //echo file_get_contents('http://example.com/', false, $ctx); 
        //$url = "http://cep.la/SP/";
        $estados = Estado::all();
        $i = 0;
        foreach($estados as $estado){
            $uf = $estado->uf;
            $url = "http://educacao.dadosabertosbr.com/api/cidades/$uf";
            //$ch  = curl_init($url);
            $context = stream_context_create($opts);
            $cid = file_get_contents($url, false, $context, null); 
            
            dump($estado->uf);
           $file = explode(':',$cid);
           for($c = 0; $c < count($file); $c++){

                $string = explode(",", $file[$c]);

                $dados = str_replace(['[', '"', '","', ']'], '', $string[0]);
                $cidade = Cidade::where("nome",  $dados)->where("estado_id",$estado->id)->first();
                if (empty($cidade)) {
                    $cidade = new Cidade;
                    $cidade->nome =   $dados ;
                    $cidade->estado_id = $estado->id;
                    $cidade->save();
                    $this->info("adicionando cidade ". $dados. " para o estado ". $estado->uf); 
                } else {
                    $this->info("ja foi cadastrado ");
                } 
                
                
            }
            $i ++;
            //exit;
        }             
        return;
    }
    public function bairro(){
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json"
            ]
        ];
        
        $context = stream_context_create($opts); 
        //echo file_get_contents('http://example.com/', false, $ctx); 
        //$url = "http://cep.la/SP/";
        $cidades = Cidade::all();
        for($c = 1; $c <= 2; $c++){
            //dump($cid);
           // $uf = strtolower($cidade->estado->uf);
            $url = "http://cep.la/pr/curitiba/$c";
            $bair = file_get_contents($url, false, $context, null);  
            $br = json_decode($bair, true);
            //$file = explode(':',$br);
            for ($i=0; $i < count($br); $i++) { 
                # code...
                dump($br[$i]["bairro"]);                 
            }
        }
        
        /* foreach($cidades as $cidade){
            
            $cid = Str::kebab(strtolower($cidade->nome));

            
    
           for($c = 1; $c <= 2; $c++){
                dump($cid);
                $uf = strtolower($cidade->estado->uf);
                $url = "http://cep.la/$uf/$cid/$c";
                // $bair = file_get_contents($url, false, $context, null);  
                dump($url);                 
            }
            $i ++; 
            //exit;
        }          */    
        return;
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class MVC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mvc {nome}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria toda a estrutura de arquivos necessaria para implementar um novo CRUD no painel';

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
     * @return mixed
     */
    public function handle()
    {
        $nome = $this->argument('nome');
        $caminho = array(
            'model' =>'app/',
            'view' =>'resources/views/',
            'controller' =>'app/Http/Controllers/',
            'lang' =>'resources/lang/pt-br/',
            'mymodel' =>'app/Console/Commands/bases/model/model.php.txt',
            'myview' =>'app/Console/Commands/bases/view/',
            'mycontroller' =>'app/Console/Commands/bases/controller/controller.php.txt',
            'mylang' =>'app/Console/Commands/bases/lang/lang.php'
        );

        if(!empty($nome)){

            file_put_contents($caminho['model'].$nome.'.php',strtr(file_get_contents($caminho['mymodel']),array('{CLASS_NAME}' => $nome)));
            $this->info('model criada!');

            if(mkdir($caminho['view'].strtolower($nome),0777)){
                file_put_contents($caminho['view'].strtolower($nome).'/config.json',file_get_contents($caminho['myview'].'config.json'));
                $this->info('view criada!');
            }

            $nomeController = $nome.'Controller';
            file_put_contents($caminho['controller'].$nomeController.'.php',strtr(file_get_contents($caminho['mycontroller']),array('{CLASS_NAME}' => $nomeController,'{MODEL_NAME}' => $nome)));
            $this->info('controller criado!');

            file_put_contents($caminho['lang'].strtolower($nome).'.php',file_get_contents($caminho['mylang']));
            $this->info('lang criado!');

        }
        else{
            $this->info('O nome deve ser informado');
        }

    }
}



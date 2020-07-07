<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class ModuleApiCrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module:api
        {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crud generator on the fly';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->controllerPath = app_path("/Http/Controllers/{name}Controller.php");
        $this->modelPath = app_path("/Models/{name}.php");
        $this->requestPath = app_path("/Http/Requests/{name}Request.php");
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->controllerPath = str_replace('{name}', $name, $this->controllerPath);
        $this->modelPath = str_replace('{name}', $name, $this->modelPath);
        $this->requestPath = str_replace('{name}', $name, $this->requestPath);

        if(File::exists($this->controllerPath)){
            $this->info("{$this->controllerPath} exists. Aborting...");
            exit;
        }elseif(File::exists($this->modelPath)){
            $this->info("{$this->modelPath} exists. Aborting...");
            exit;
        }elseif(File::exists($this->requestPath)){
            $this->info("{$this->requestPath} exists. Aborting...");
            exit;
        }

        $this->controller($name);
        $this->model($name);
        $this->request($name);

        $routeName = Str::plural(strtolower($name));

        if(!Route::has($routeName.".index"))
           File::append(base_path('routes/api.php'), 'Route::resource(\'' . $routeName . "', '{$name}Controller');");
    }

    protected function controller($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name)
            ],
            $this->getStub('ApiController')
        );

        file_put_contents($this->controllerPath, $controllerTemplate);
    }

    protected function model($name)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        file_put_contents($this->modelPath, $modelTemplate);
    }

    protected function request($name)
    {
        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Request')
        );

        if(!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents($this->requestPath, $requestTemplate);
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class ModuleCrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module
        {name : Class (singular) for example User}
        {--columns=string:name : database table fields}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crud generator on the fly';

    protected $modelNamePluralLowerCase;

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
        $name = ucfirst($this->argument('name'));

        $this->modelNamePluralLowerCase = strtolower(Str::plural($name));

        $files = [];

        $files[] = $this->controllerPath = app_path("\Http\Controllers\\{$name}Controller.php");
        $files[] = $this->modelPath = app_path("\Models\\{$name}.php");
        $files[] = $this->requestPath = app_path("\Http\Requests\\{$name}Request.php");

        $migrationDate = date('Y_m_d');
        $files[] = $this->migrationPath = database_path("migrations\\{$migrationDate}_000000_create_{$this->modelNamePluralLowerCase}_table.php");

        $this->viewPath = resource_path("views\modules\\{$this->modelNamePluralLowerCase}");
        $files[] = $this->viewPath."\index.blade.php";
        $files[] = $this->viewPath."\create.blade.php";
        $files[] = $this->viewPath."\edit.blade.php";

        $this->checkFileIfExists($files);

        $this->controller($name);
        $this->model($name);
        $this->request($name);
        $this->migration($name);
        $this->view($name);

        foreach($files as $file){
            $this->info($file.' successfully created.');
        }

        $routeName = Str::plural(strtolower($name));

        if(!Route::has($routeName.".index")){
            File::append(base_path('routes/web.php'), 'Route::resource(\'' . $routeName . "', '{$name}Controller');");
            $this->info('New route resource successfully added.');
        }
           


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
                $this->modelNamePluralLowerCase,
                strtolower($name)
            ],
            $this->getStub('Controller')
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

    protected function migration($name)
    {

        $columns = $this->option('columns');

        if(!empty($columns)){

            $columnsArr = explode('|', $columns);

            $columns = null;

            foreach($columnsArr as $column){
                if (($pos = strpos($column, ":")) !== FALSE) { 
                    $fieldType = substr($column, 0, $pos); 
                    $fieldName = substr($column, $pos+1); 
                    $columns .= '$table->'.$fieldType."('$fieldName');";
                }
            }
        }

        $migrationTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{columns}}'
            ],
            [
                ucfirst($this->modelNamePluralLowerCase),
                $this->modelNamePluralLowerCase,
                $columns
            ],
            $this->getStub('Migration')
        );

        file_put_contents($this->migrationPath, $migrationTemplate);
    }

    protected function view($name)
    {
        $columns = $this->option('columns');

        $createInputFields = $editInputFields = $indexColumnHeaders =  $indexColumns = '';


        $columnsArr = explode('|', $columns);

        $columns = null;

        foreach($columnsArr as $column){
            if (($pos = strpos($column, ":")) !== FALSE) { 
                $fieldType = substr($column, 0, $pos); 
                $fieldName = substr($column, $pos+1); 

                $createInputFields .= str_replace(
                    [
                        '{{fieldNameLowerCase}}',
                        '{{fieldNameUpperCase}}'
                    ],
                    [
                        strtolower($fieldName),
                        ucfirst($fieldName)
                    ],
                    $this->getStub('views/create-input.blade')
                );

                $editInputFields .= str_replace(
                    [
                        '{{fieldNameLowerCase}}',
                        '{{fieldNameUpperCase}}',
                        '{{modelNameLowerCase}}'
                    ],
                    [
                        strtolower($fieldName),
                        ucfirst($fieldName),
                        strtolower($name)
                    ],
                    $this->getStub('views/edit-input.blade')
                );

                $indexColumnHeaders .= "\n" . str_replace(
                    [
                        '{{modelNameLowerCase}}',
                        '{{fieldType}}'
                    ],
                    [
                        strtolower($name),
                        $fieldType
                    ],
                    $this->getStub('views/index-column-headers.blade')
                );

                $indexColumns .= "\n" . str_replace(
                    [
                        '{{modelNameLowerCase}}',
                        '{{fieldName}}'
                    ],
                    [
                        strtolower($name),
                        $fieldName
                    ],
                    $this->getStub('views/index-column.blade')
                );
            }
        }

        $indexTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNameTitle}}',
                '{{modelNameLowerCase}}',
                '{{modelNamePluralLowerCase}}',
                '{{indexColumnHeaders}}',
                '{{indexColumns}}'
            ],
            [
                $name,
                ucfirst($this->modelNamePluralLowerCase),
                strtolower($name),
                $this->modelNamePluralLowerCase,
                $indexColumnHeaders,
                $indexColumns
            ],
            $this->getStub('views/index.blade')
        );

        

        $createTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{createInputFields}}'
            ],
            [
                $name,
                $this->modelNamePluralLowerCase,
                $createInputFields

            ],
            $this->getStub('views/create.blade')
        );

        $editTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNameLowerCase}}',
                '{{modelNamePluralLowerCase}}',
                '{{editInputFields}}'
            ],
            [
                $name,
                strtolower($name),
                $this->modelNamePluralLowerCase,
                $editInputFields
            ],
            $this->getStub('views/edit.blade')
        );

        if(!file_exists($path = $this->viewPath))
            mkdir($path, 0777, true);

        file_put_contents($this->viewPath."/create.blade.php", $createTemplate);
        file_put_contents($this->viewPath."/edit.blade.php", $editTemplate);
        file_put_contents($this->viewPath."/index.blade.php", $indexTemplate);
    }

    protected function checkFileIfExists($files)
    {
        foreach ($files as $file) {
            if(File::exists($file)){
                $this->info("{$file} exists. Aborting...");
                exit;
            }
        }
        return false;
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Module CLI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        if (File::exists(base_path('modules/' . $name))) {
            $this->error('Module already exists!');
        } else {
            File::makeDirectory(base_path('modules/' . $name), 0755, true, true);

            //Create config
            $configFolder = base_path('modules/' . $name . '/configs');
            if (!File::exists($configFolder)) {
                File::makeDirectory($configFolder, 0755, true, true);
            }

            //Create helper
            $helperFolder = base_path('modules/' . $name . '/helpers');
            if (!File::exists($helperFolder)) {
                File::makeDirectory($helperFolder, 0755, true, true);
            }

            //Create migrations
            $migrationsFolder = base_path('modules/' . $name . '/migrations');
            if (!File::exists($migrationsFolder)) {
                File::makeDirectory($migrationsFolder, 0755, true, true);
            }

            //Create resources
            $resourcesFolder = base_path('modules/' . $name . '/resources');
            if (!File::exists($resourcesFolder)) {
                File::makeDirectory($resourcesFolder, 0755, true, true);

                //Create lang
                $langFolder = base_path('modules/' . $name . '/resources/lang');
                if (!File::exists($langFolder)) {
                    File::makeDirectory($langFolder, 0755, true, true);
                }

                //Create views
                $viewsFolder = base_path('modules/' . $name . '/resources/views');
                if (!File::exists($viewsFolder)) {
                    File::makeDirectory($viewsFolder, 0755, true, true);
                }
            }

            //Create routes
            $routesFolder = base_path('modules/' . $name . '/routes');
            if (!File::exists($routesFolder)) {
                File::makeDirectory($routesFolder, 0755, true, true);

                //Create routes.php
                $routesFile = base_path('modules/' . $name . '/routes/routes.php');
                if (!File::exists($routesFile)) {
                    File::put($routesFile, "<?php\n\nuse Illuminate\Support\Facades\Route;\n\nRoute::middleware('demo')->get('{$name}', function () {\n    return config('config.tet');\n});\n\nRoute::group(['namespace' => 'Modules\\{$name}\\src\\Http\\Controllers'], function () {\n    Route::prefix('{$name}')->group(function () {\n        Route::get('/', '{$name}Controller@index');\n\n        Route::get('/detail/{id}', '{$name}Controller@detail');\n\n        Route::get('/create', '{$name}Controller@create');\n    });\n\n});\n");
                }
            }

            //Create src
            $srcFolder = base_path('modules/' . $name . '/src');
            if (!File::exists($srcFolder)) {
                File::makeDirectory($srcFolder, 0755, true, true);

                //Create Commands
                $commandsFolder = base_path('modules/' . $name . '/src/Commands');
                if (!File::exists($commandsFolder)) {
                    File::makeDirectory($commandsFolder, 0755, true, true);
                }

                //Create Http
                $httpFolder = base_path('modules/' . $name . '/src/Http');
                if (!File::exists($httpFolder)) {
                    File::makeDirectory($httpFolder, 0755, true, true);

                    //Create Controllers
                    $controllersFolder = base_path('modules/' . $name . '/src/Http/Controllers');
                    if (!File::exists($controllersFolder)) {
                        File::makeDirectory($controllersFolder, 0755, true, true);
                    }

                    //Create Middlewares
                    $middlewaresFolder = base_path('modules/' . $name . '/src/Http/Middlewares');
                    if (!File::exists($middlewaresFolder)) {
                        File::makeDirectory($middlewaresFolder, 0755, true, true);
                    }
                }

                //Create Models
                $modelsFolder = base_path('modules/' . $name . '/src/Models');
                if (!File::exists($modelsFolder)) {
                    File::makeDirectory($modelsFolder, 0755, true, true);
                }

                //Crreate Repositories
                $repositoriesFolder = base_path('modules/' . $name . '/src/Repositories');
                if (!File::exists($repositoriesFolder)) {
                    File::makeDirectory($repositoriesFolder, 0755, true, true);

                    //Create ModuleRepository File
                    $moduleRepositoryFile = base_path('modules/' . $name . '/src/Repositories/' . $name . 'Repository.php');
                    if (!File::exists($moduleRepositoryFile)) {
                        $moduleRepositoryFileContent = file_get_contents(app_path('Console/Commands/Templates/ModuleRepository.txt'));
                        $moduleRepositoryFileContent = str_replace('{module}', $name, $moduleRepositoryFileContent);
                        File::put($moduleRepositoryFile, $moduleRepositoryFileContent);
                    }

                    //Create ModuleRepositoryInterface File
                    $moduleRepositoryInterfaceFile = base_path('modules/' . $name . '/src/Repositories/' . $name . 'RepositoryInterface.php');
                    if (!File::exists($moduleRepositoryInterfaceFile)) {
                        $moduleRepositoryInterfaceFileContent = file_get_contents(app_path('Console/Commands/Templates/ModuleRepositoryInterface.txt'));
                        $moduleRepositoryInterfaceFileContent = str_replace('{module}', $name, $moduleRepositoryInterfaceFileContent);
                        File::put($moduleRepositoryInterfaceFile, $moduleRepositoryInterfaceFileContent);
                    }
                }
            }


            $this->info('Module created successfully!');
        }
    }
}

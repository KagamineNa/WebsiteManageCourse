<?php
namespace Modules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Modules\User\src\Repositories\UserRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;


class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    private $middlewares = [
        // 'demo' => DemoMiddleware::class
    ];

    private $commands = [
        // TestCommand::class
    ];

    public function register()
    {
        //Khai báo configs
        $direcrories = $this->getModule();
        if (!empty($direcrories)) {
            foreach ($direcrories as $directory) {
                $this->registerConfig($directory);
            }
        }

        //Khai báo middlewares
        $this->registerMiddleware();

        //Khai báo commands
        $this->commands($this->commands);


        $repositories = [
            UserRepositoryInterface::class => UserRepository::class,
            CategoriesRepositoryInterface::class => CategoriesRepository::class,
            CoursesRepositoryInterface::class => CoursesRepository::class,
            TeacherRepositoryInterface::class => TeacherRepository::class,
            // Thêm các cặp interface và class khác vào đây
        ];

        foreach ($repositories as $interface => $class) {
            $this->app->singleton($interface, $class);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $direcrories = $this->getModule();
        if (!empty($direcrories)) {
            foreach ($direcrories as $directory) {
                $this->registerModule($directory);
            }
        }
    }

    private function getModule()
    {
        $direcrories = array_map('basename', File::directories(__DIR__));
        return $direcrories;
    }

    private function registerModule($module)
    {
        $modulePath = __DIR__ . "/{$module}";

        //Khai báo Routes
        if (File::exists($modulePath . '/routes/routes.php')) {
            $this->loadRoutesFrom($modulePath . '/routes/routes.php');
        }

        //Khai báo Migrations
        if (File::exists($modulePath . '/migrations')) {
            $this->loadMigrationsFrom($modulePath . '/migrations');
        }
        //Khai báo languages
        if (File::exists($modulePath . '/resources/lang')) {
            $this->loadTranslationsFrom($modulePath . '/resources/lang', $module);
            $this->loadJsonTranslationsFrom($modulePath . '/resources/lang');
        }

        //Khai báo views
        if (File::exists($modulePath . '/resources/views')) {
            $this->loadViewsFrom($modulePath . '/resources/views', strtolower($module));
        }

        //Khai báo helpers
        if (File::exists($modulePath . '/helpers')) {
            $helperList = File::allFiles($modulePath . '/helpers');
            if (!empty($helperList)) {
                foreach ($helperList as $helper) {
                    $file = $helper->getPathname();
                    require $file;
                }
            }
        }

    }

    private function registerConfig($module)
    {
        $configPath = __DIR__ . '/' . $module . "/configs";
        if (File::exists($configPath)) {
            $configFile = array_map('basename', File::allFiles($configPath));

            foreach ($configFile as $config) {
                $alias = basename($config, '.php');
                $this->mergeConfigFrom($configPath . '/' . $config, $alias);
            }
        }

    }

    private function registerMiddleware()
    {
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }
}
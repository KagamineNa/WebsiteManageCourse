<?php
namespace Modules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;
use Modules\Document\src\Repositories\DocumentRepository;
use Modules\User\src\Repositories\UserRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\Home\src\Repositories\HomeRepository;
use Modules\Home\src\Repositories\HomeRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepository;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Modules\Video\src\Repositories\VideoRepository;
use Modules\Video\src\Repositories\VideoRepositoryInterface;
use Modules\Students\src\Repositories\StudentsRepository;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;
use Modules\Orders\src\Repositories\OrdersRepository;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use Modules\Auth\src\Http\Middlewares\BlockUserMiddleware;



class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    private $middlewares = [
        // 'demo' => DemoMiddleware::class
        'user.block' => BlockUserMiddleware::class
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
            HomeRepositoryInterface::class => HomeRepository::class,
            LessonsRepositoryInterface::class => LessonsRepository::class,
            VideoRepositoryInterface::class => VideoRepository::class,
            DocumentRepositoryInterface::class => DocumentRepository::class,
            StudentsRepositoryInterface::class => StudentsRepository::class,
            OrdersRepositoryInterface::class => OrdersRepository::class,
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

        Paginator::useBootstrapFive();

        $request = request();
        if ($request->is('admin') || $request->is('admin/*')) {
            $this->app['router']->pushMiddlewareToGroup('web', 'auth');
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

        Route::group(['namespace' => "Modules\\{$module}\src\Http\Controllers", 'middleware' => 'web'], function () use ($modulePath) {
            if (File::exists($modulePath . '/routes/web.php')) {
                $this->loadRoutesFrom($modulePath . '/routes/web.php');
            }
        });

        Route::group(['namespace' => "Modules\\{$module}\src\Http\Controllers", 'middleware' => 'api', 'prefix' => 'api'], function () use ($modulePath) {
            if (File::exists($modulePath . '/routes/api.php')) {
                $this->loadRoutesFrom($modulePath . '/routes/api.php');
            }
        });

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
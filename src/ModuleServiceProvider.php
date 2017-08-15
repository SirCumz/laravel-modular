<?php

namespace SirCumz\LaravelModular;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ModuleServiceProvider extends ServiceProvider
{
    protected $moduleName;

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;

        $this->moduleName = basename(str_replace('\ServiceProvider','',get_class($this)));
    }

    /**
     * Load the given routes file if routes are not already cached.
     *
     * @param  string  $path
     * @return void
     */
    protected function loadWebRoutes($path = 'web.php')
    {
        if (! $this->app->routesAreCached()) {
            Route::middleware('web')
                 ->namespace('App\Modules\\' . $this->moduleName . '\Controllers')
                 ->group(app_path('Modules//' . $this->moduleName . '//' . $path ));            
        }
    }

    /**
     * Load the given routes file if routes are not already cached.
     *
     * @param  string  $path
     * @return void
     */
    protected function loadAdminRoutes($path = 'admin.php')
    {
        if (! $this->app->routesAreCached()) {
            Route::middleware(['web', 'admin'])
                 ->namespace('App\Modules\\' . $this->moduleName . '\Controllers')
                 ->group(app_path('Modules//' . $this->moduleName . '//' . $path ));            
        }
    }

    /**
     * Load the given routes file if routes are not already cached.
     *
     * @param  string  $path
     * @return void
     */
    protected function loadApiRoutes($path = 'api.php')
    {
        if (! $this->app->routesAreCached()) {
            Route::prefix('api')
                 ->middleware('api')
                 ->namespace('App\Modules\\' . $this->moduleName . '\Controllers')
                 ->group(app_path('Modules//' . $this->moduleName . '//' . $path ));            
        }
    }

    /**
     * Register a view file namespace.
     *
     * @param  string  $path
     * @param  string  $namespace
     * @return void
     */
    protected function loadViews($path = 'views')
    {
        $path = app_path('Modules//' . $this->moduleName . '//' . $path);

        // if (is_dir($appPath = $this->app->resourcePath().'/views/vendor/'.$this->moduleName)) {
        //     $this->app['view']->addNamespace($this->moduleName, $appPath);
        // }

        $this->app['view']->addNamespace($this->moduleName, themes_path('{theme}/Modules//' . $this->moduleName) );
        $this->app['view']->addNamespace($this->moduleName, themes_path('default/Modules//' . $this->moduleName) );
        $this->app['view']->addNamespace($this->moduleName, $path);    
    }

    /**
     * Register a translation file namespace.
     *
     * @param  string  $path
     * @param  string  $namespace
     * @return void
     */
    protected function loadTranslations($path = 'lang')
    {
        $path = app_path('Modules//' . $this->moduleName . '//' . $path);

        $this->app['translator']->addNamespace($this->moduleName, $path);
    }

    /**
     * Register a database migration path.
     *
     * @param  array|string  $paths
     * @return void
     */
    protected function loadMigrations($path = 'Migrations')
    {
        $path = app_path('Modules//' . $this->moduleName . '//' . $path);

        $this->app->afterResolving('migrator', function ($migrator) use ($path) {
                $migrator->path($path);
        });
    }

    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param  string  $path
     * @param  string  $key
     * @return void
     */
    protected function mergeConfigFrom($path, $key)
    {
        $path = app_path('Modules//' . $this->moduleName . '//config//' . $path);

        $config = $this->app['config']->get($key, []);

        $this->app['config']->set($key, array_merge(require $path, $config));
    }

    public function moduleName()
    {
        return $this->moduleName;
    }
}
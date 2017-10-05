<?php

namespace SirCumz\LaravelModular;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ModuleServiceProvider extends ServiceProvider
{

    /**
     * Module name.
     *
     * @return string
     */
    protected $moduleName;

    /**
     * Module namespace.
     *
     * @return string
     */
    protected $namespace;    

    /**
     * Module path.
     *
     * @return string
     */
    protected $path;

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;

        $reflection = new \ReflectionClass($this);

        $this->namespace = $reflection->getNamespaceName();
        $this->path = dirname($reflection->getFileName());
        $this->moduleName = basename($this->namespace);  
    }

    /**
     * Load the Web routes file if routes are not already cached.
     *
     * @param  string  $path
     * @return void
     */
    protected function loadWebRoutes($path = 'web.php')
    {
        if (! $this->app->routesAreCached()) {
            Route::middleware('web')
                 ->namespace($this->namespace('Controllers'))
                 ->group($this->path($path));            
        }
    }

    /**
     * Load the Admin routes file if routes are not already cached.
     *
     * @param  string  $path
     * @return void
     */
    protected function loadAdminRoutes($path = 'admin.php')
    {
        if (! $this->app->routesAreCached()) {
            Route::middleware(['web', 'admin'])
                 ->namespace($this->namespace('Controllers'))
                 ->group($this->path($path));            
        }
    }

    /**
     * Load the Api routes file if routes are not already cached.
     *
     * @param  string  $path
     * @return void
     */
    protected function loadApiRoutes($path = 'api.php')
    {
        if (! $this->app->routesAreCached()) {
            Route::prefix('api')
                 ->middleware('api')
                 ->namespace($this->namespace('Controllers'))
                 ->group($this->path($path));            
        }
    }

    /**
     * Register view file locations.
     *
     * @param  string  $path
     * @param  string  $namespace
     * @return void
     */
    protected function loadViews($path = 'views')
    {
        $this->app['view']->addNamespace($this->moduleName, [
            themes_path('{theme}/Modules/' . $this->moduleName),
            themes_path('default/Modules/' . $this->moduleName),
            $this->path($path)
        ]);   
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
        $this->app['translator']->addNamespace($this->moduleName, $this->path($path));
    }

    /**
     * Register a database migration path.
     *
     * @param  array|string  $paths
     * @return void
     */
    protected function loadMigrations($path = 'Migrations')
    {
        $this->app->afterResolving('migrator', function ($migrator) use ($path) {
                $migrator->path($this->path($path));
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
        $config = $this->app['config']->get($key, []);

        $this->app['config']->set($key, array_merge(require $this->path('config/' . $path), $config));
    }

    /**
     * Enable module asset mixing.
     *
     * @param  string  $file
     * @return void
     */
    public function mixable( $file = 'mix.php' )
    {
        return $this->app['mixable']->mix(function($mix) use($file) {
            if(is_callable($file)) {
                $file($mix);
            } else {
                include($this->path($file));
            }            
        });
    }

    /**
     * Module name.
     *
     * @return string
     */
    public function moduleName()
    {
        return $this->moduleName;
    }

    /**
     * Module path.
     *
     * @return string
     */
    public function path( $path = null )
    {
        return $this->path . (($path) ? '/' . $path : null);
    }    


    /**
     * Module namespace.
     *
     * @return string
     */
    public function namespace( $path = null )
    {
        return $this->namespace . (($path) ? '\\' . $path : null);
    }     
}

<?php

namespace SirCumz\LaravelModular;

use Illuminate\Support\ServiceProvider;

class LaravelModularServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app['files']->exists( modules_path() ))
        {
            foreach($this->app['files']->directories( modules_path() ) as $dir)
            {
                if($this->app['files']->exists($dir. '\ServiceProvider.php'))
                {
                    $this->app->register('App\Modules\\' . basename($dir) . '\ServiceProvider');
                }        
            }   
        } 
    }
}

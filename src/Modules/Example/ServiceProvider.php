<?php

namespace App\Modules\Example;

use SirCumz\LaravelModular\ModuleServiceProvider;

class ServiceProvider extends ModuleServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadWebRoutes();

        $this->loadMigrations();    
        
        $this->loadTranslations();     
        
        $this->loadViews(); 

        //
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
       $this->mergeConfigFrom(
            'example.php', 'Example'
        );
    }
}

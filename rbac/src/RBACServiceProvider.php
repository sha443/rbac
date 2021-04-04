<?php

namespace sha443\rbac;

use Illuminate\Support\ServiceProvider;

class RBACServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // load routes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php', 'rbac');

        // load migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        
        // push middleware to the web group
        $this->app['router']->pushMiddlewareToGroup('rbac', \sha443\rbac\Http\Middleware\RolesAuth::class);       
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->mergeConfigFrom(__DIR__.'/config/rbac.php','rbac');

        // $this->app->make('sha443\rbac\Http\Controllers\RBACController');

        // RBAC Facades
        $this->app->singleton(RBAC::class, function (){
            return new RBAC();
        });

        // $this->bindClasses();
    }

    // bind package classes to laravel app
    // protected function bindClasses(): void
    // {
    //     $this->app->bind(Test::class);
    // }
}

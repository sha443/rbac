<?php

namespace sha443\rbac;

use Illuminate\Support\ServiceProvider;

use sha443\rbac\Console\Commands\Install;
use sha443\rbac\Console\Commands\DbSeed;

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

        // load views
        $this->loadViewsFrom(__DIR__.'/views/', 'rbac');
        
        // push middleware to the web group
        $this->app['router']->pushMiddlewareToGroup('rbac', \sha443\rbac\Http\Middleware\RolesAuth::class);
        $this->app['router']->pushMiddlewareToGroup('rbac', \sha443\rbac\Http\Middleware\RolesMenu::class);

        // publish assets
        $this->publishes(
            [__DIR__.'/public/' => public_path('vendor/rbac'), ]
            , 'public');

        // register commands 
        if ($this->app->runningInConsole())
        {
            $this->commands([
                Install::class,
                DbSeed::class,
            ]);
        }
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

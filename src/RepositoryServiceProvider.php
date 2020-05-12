<?php
namespace Laraditz\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
        $this->publishes([
            __DIR__ . '/../config/repository.php' => $this->configPath('repository.php'),
        ]);

        // register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Laraditz\Repository\Commands\RepositoryMakeCommand::class,
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/repository.php',
            'repository'
        );

        // Register the service the package provides.
        $this->app->singleton('Repository', function ($app) {
            return new RepositoryContainer;
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Repository'];
    }

    public function configPath($file)
    {
        if (function_exists('config_path')) {
            return config_path($file);
        } else {
            return base_path('config/'.$file);
        }
    }
}

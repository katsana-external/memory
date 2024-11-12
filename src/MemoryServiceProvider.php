<?php

namespace Orchestra\Memory;

use Illuminate\Contracts\Container\Container;
use Laravel\Octane\Events\RequestReceived;
use Orchestra\Support\Providers\ServiceProvider;

class MemoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->singleton('orchestra.memory', function (Container $app) {
            return new MemoryManager($app);
        });
    }

    /**
     * Bootstrap the application events.
     */
    public function boot(): void
    {
        $path = \realpath(__DIR__ . '/../');

        $this->registerConfiguration($path);

        $this->loadMigrationsFrom([
            "{$path}/database/migrations",
        ]);

        $this->bootEvents();
    }

    /**
     * Register memory events during booting.
     */
    protected function bootEvents(): void
    {
        $this->callAfterResolving('orchestra.memory', function ($manager, $app) {
            $manager->setConfiguration($app->make('config')->get('orchestra.memory'));
        });

        $this->app['events']->listen(RequestReceived::class, function ($event) {
            $event->sandbox->make('orchestra.memory')->finish();
        });

        $this->app->terminating(function () {
            app('orchestra.memory')->finish();
        });
    }

    /**
     * Register configuration.
     */
    protected function registerConfiguration(string $path): void
    {
        $this->mergeConfigFrom("{$path}/config/config.php", 'orchestra.memory');

        $this->publishes([
            "{$path}/config/config.php" => config_path('orchestra/memory.php'),
        ], ['orchestra-memory', 'laravel-config']);
    }
}

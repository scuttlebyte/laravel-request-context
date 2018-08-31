<?php

namespace Scuttlebyte\ContextManager\Laravel;

use http\Env\Request;
use Scuttlebyte\ContextManager\ContextManager;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ContextManager::class, function ($app) {
            return new ContextManager();
        });
    }

    public function provides() {
        return [ContextManager::class];
    }

    /**
     * Boot methods for the package
     */
    public function boot()
    {
        // Laravel takes over `$this` context over in the macro closure,
        // so we have to bind $this->app to a variable here instead.
        $app = $this->app;

        $this->app['request']->macro('context', function () use ($app) {
            return $app[ContextManager::class];
        });
    }
}

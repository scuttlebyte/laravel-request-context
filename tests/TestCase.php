<?php

namespace Tests;

use Scuttlebyte\ContextManager\Laravel\ServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
}

<?php

namespace Scuttlebyte\ContextManager\Tests\Scuttlebyte\Laravel;

use Scuttlebyte\ContextManager\ContextManager;
use Scuttlebyte\ContextManager\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function registers_in_the_service_container()
    {
        self::assertInstanceOf(ContextManager::class, $this->app[ContextManager::class]);
    }

    /**
     * @test
     */
    public function binds_a_macro_for_context_to_the_request()
    {
        self::assertInstanceOf(ContextManager::class, $this->app['request']->context());
    }

    /**
     * @test
     */
    public function binds_a_helper_method()
    {
        self::assertInstanceOf(ContextManager::class, context());
    }
}

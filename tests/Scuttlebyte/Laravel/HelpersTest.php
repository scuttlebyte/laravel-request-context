<?php

namespace Scuttlebyte\ContextManager\Tests\Scuttlebyte\Laravel;

use Scuttlebyte\ContextManager\ContextManager;
use Scuttlebyte\ContextManager\Laravel\Facade;
use Scuttlebyte\ContextManager\Tests\TestCase;

class HelpersTest extends TestCase
{
    /**
     * @test
     */
    public function binds_a_helper_method()
    {
        self::assertInstanceOf(ContextManager::class, context());
    }

    /**
     * @test
     */
    public function puts_and_gets_a_context_from_helper_method()
    {
        context('Sid', "Let's go home and play.");

        self::assertEquals("Let's go home and play.", context('Sid'));
    }

    /**
     * @test
     */
    public function puts_and_gets_an_array_of_contexts_from_helper_method()
    {
        context([
            'Sid' => "Let's go home and play.",
            'Woody' => 'Reach for the sky!',
            'Buzz' => 'You are a sad, strange little man, and you have my pity.'
        ]);

        self::assertEquals("You are a sad, strange little man, and you have my pity.", context('Buzz'));
        self::assertEquals("Reach for the sky!", context('Woody'));
        self::assertEquals("Let's go home and play.", context('Sid'));
    }

    /**
     * @test
     */
    public function puts_and_gets_a_context_from_facade()
    {
        \Context::put('Woody', "Somebody poisoned the watering hole!");

        self::assertEquals("Somebody poisoned the watering hole!", \Context::get('Woody'));
    }

    protected function getPackageAliases($app)
    {
        return [
            'Context' => Facade::class
        ];
    }
}

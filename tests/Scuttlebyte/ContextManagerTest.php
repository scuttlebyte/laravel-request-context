<?php

namespace Scuttlebyte\ContextManager\Tests;

use PHPUnit\Framework\TestCase;
use Scuttlebyte\ContextManager\ContextManager;

class ContextManagerTest extends TestCase
{
    /**
     * @test
     * @expectedException \Scuttlebyte\ContextManager\Exception\UnregisteredContextException
     */
    public function throws_exceptions_when_a_context_has_not_been_registered()
    {
        $sut = new ContextManager();

        $sut->put('Woody', "There's a snake in my boots!");

        $sut->get('Buzz');
    }

    /**
     * @test
     * @dataProvider keyValuePairProvider
     */
    public function puts_and_gets_a_context_as_key_value_pair($key, $value)
    {
        $sut = new ContextManager();

        $sut->put($key, $value);

        self::assertEquals($value, $sut->get($key));
    }

    /**
     * @test
     */
    public function gets_all_contexts()
    {
        $sut = new ContextManager();

        $sut->put('Woody', "There's a snake in my boots!");
        $sut->put('Buzz', 'To Infinity, and beyond!');


        self::assertEquals([
                'Woody' => "There's a snake in my boots!",
                'Buzz' => 'To Infinity, and beyond!'
            ],
            $sut->all()
        );
    }

    public function keyValuePairProvider () {
        return [
            'string' => [
                'Buzz', 'To Infinity, and beyond!'
            ],
            'object' => [
                'Class', new \stdClass()
            ],
            'integer' => [
                'three', 3
            ],
            'float' => [
                'three-point-o', 3.0
            ],
            'array' => [
                'multi-dimensional, keyless arrays',
                [
                    'level' => 'one',
                    [
                        'level' =>
                            [
                                'two' => 'three'
                            ]
                    ]
                ]
            ]
        ];
    }

    public function arrayProvider()
    {
        return [
            'string' => [
                ['Buzz' => 'To Infinity, and beyond!']
            ],
            'object' => [
                ['Class' => new \stdClass()]
            ],
            'integer' => [
                ['three' => 3]
            ],
            'float' => [
                ['three-point-o' => 3.0]
            ]
        ];
    }

    /**
     * @test
     * @dataProvider arrayProvider
     */
    public function puts_and_gets_a_context_as_array($array)
    {
        $sut = new ContextManager();

        $sut->put($array);

        foreach ($array as $key => $item) {
            self::assertEquals($item, $sut->get($key));
        }

    }
}

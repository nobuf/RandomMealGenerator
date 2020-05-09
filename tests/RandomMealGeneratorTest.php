<?php

namespace App\Tests;

use App\Meal;
use App\RandomMealGenerator;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class RandomMealGeneratorTest extends TestCase
{
    public function testResponseOfGenerateContainsRecipeName()
    {
        $mock = new MockHandler([
            new Response(200, [], RandomMealSeed::fetchAsString())
        ]);
        $handlerStack = HandlerStack::create($mock);
        $generator = new RandomMealGenerator(
            new Client([
                'handler' => $handlerStack,
            ])
        );

        $meal = $generator->generate();

        $this->assertInstanceOf(
            Meal::class,
            $meal
        );

        $this->assertSame(
            'Beef Lo Mein',
            $meal->recipeName
        );
    }

    public function testGenerateReturnsDifferentResultInSecondTime()
    {
        $mock = new MockHandler([
            new Response(200, [], RandomMealSeed::fetchAsString('random_meal1.json')),
            new Response(200, [], RandomMealSeed::fetchAsString('random_meal2.json')),
        ]);
        $handlerStack = HandlerStack::create($mock);

        $generator = new RandomMealGenerator(
            new Client([
                'handler' => $handlerStack,
            ])
        );

        $firstRecipeName = $generator->generate()->recipeName;
        $secondRecipeName = $generator->generate()->recipeName;

        $this->assertNotSame(
            $firstRecipeName,
            $secondRecipeName
        );
    }
}

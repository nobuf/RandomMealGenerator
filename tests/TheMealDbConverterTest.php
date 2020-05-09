<?php

namespace App\Tests;

use App\Meal;
use App\TheMealDbConverter;
use PHPUnit\Framework\TestCase;

class TheMealDbConverterTest extends TestCase
{
    public function testConvert()
    {
        $converter = new TheMealDbConverter(
            RandomMealSeed::fetch()
        );

        $this->assertInstanceOf(
            Meal::class,
            $converter->convert()
        );

        $this->assertCount(
            17,
            $converter->convert()->ingredients
        );
    }

    public function testConvertWithNullableIngredients()
    {
        // strIngredient* might be null?
        $converter = new TheMealDbConverter(
            RandomMealSeed::fetch('random_meal_with_nullable_ingredients.json')
        );

        $this->assertCount(
            6,
            $converter->convert()->ingredients
        );
    }
}

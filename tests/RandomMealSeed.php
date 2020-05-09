<?php

namespace App\Tests;

class RandomMealSeed
{
    public static function fetchAsString(string $fileName = 'random_meal1.json'): string
    {
        return file_get_contents(
            __DIR__ . '/seed/' . $fileName
        );
    }

    public static function fetch(string $fileName = 'random_meal1.json'): array
    {
        return json_decode(self::fetchAsString($fileName), true);
    }
}
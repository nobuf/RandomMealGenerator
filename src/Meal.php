<?php

namespace App;

use JsonSerializable;

class Meal implements JsonSerializable
{
    /** @var string */
    public $recipeName;

    /** @var array */
    public $ingredients;

    /**
     * @var string
     */
    public $instructions;

    /**
     * @var string
     */
    public $mealThumb;

    /**
     * @var string
     */
    public $youtube;

    public function __construct(
        string $recipeName,
        array $ingredients,
        string $instructions,
        string $mealThumb,
        string $youtube
    ) {
        $this->recipeName = $recipeName;
        $this->ingredients = $ingredients;
        $this->instructions = $instructions;
        $this->mealThumb = $mealThumb;
        $this->youtube = $youtube;
    }

    public function jsonSerialize()
    {
        return [
            'recipe_name' => $this->recipeName,
            'ingredients' => $this->ingredients,
            'instructions' => $this->instructions,
            'meal_thumb' => $this->mealThumb,
            'youtube' => $this->youtube,
        ];
    }
}
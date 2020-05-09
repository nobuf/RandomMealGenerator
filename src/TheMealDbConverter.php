<?php

namespace App;

class TheMealDbConverter
{
    /**
     * @var array
     */
    private $theMealDbResponse;

    public function __construct(array $theMealDbResponse)
    {
        $this->theMealDbResponse = $theMealDbResponse;
    }

    /**
     * Return strIngredient1 - strIngredient20 with non-blank elements
     *
     * @return string[]
     */
    private function getIngredients(): array
    {
        $ingredients = [];
        foreach ($this->theMealDbResponse['meals'][0] as $key => $value) {
            if (strpos($key, 'strIngredient') === 0
                && !empty($value)) {
                $ingredients[] = $value;
            }
        }

        return $ingredients;
    }

    public function convert(): Meal
    {
        $meal = $this->theMealDbResponse['meals'][0];

        return new Meal(
            $meal['strMeal'],
            $this->getIngredients(),
            $meal['strInstructions'],
            $meal['strMealThumb'],
            $meal['strYoutube']
        );
    }
}
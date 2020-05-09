<?php

namespace App;

use GuzzleHttp\ClientInterface;

class RandomMealGenerator
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return Meal
     */
    public function generate(): Meal
    {
        $response = $this->client->request(
            'GET',
            'https://www.themealdb.com/api/json/v1/1/random.php'
        );

        $json = $response->getBody();
        $jsonData = json_decode($json, true);

        $converter = new TheMealDbConverter($jsonData);

        return $converter->convert();
    }
}
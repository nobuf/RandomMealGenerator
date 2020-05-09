<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/random_meal', function (Request $request, Response $response, $args) {
    $generator = new \App\RandomMealGenerator(
        new \GuzzleHttp\Client()
    );
    $response->getBody()
        ->write(json_encode($generator->generate()));

    return $response
        ->withHeader('Content-Type', 'application/json');
});

$app->run();

<?php

use Slim\Factory\AppFactory;

use Slim\Routing\RouteCollectorProxy as Proxy;
use Prs\Http\Message\ResponeInterface as Response;
use Prs\Http\Message\ServerRequestInterface as Request;
use Game;


$app = AppFactory::create();

$app->group('/games/{id:[0-9]+}', function (Proxy $group) use ($Game) {
    $group->get('', function () {
    });
});

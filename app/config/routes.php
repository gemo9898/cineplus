<?php
declare(strict_types=1);

use nrv\application\actions\GetFilmsAction;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


use nrv\application\actions\HomeAction;
use app\middlewares\CorsMiddleware;



// use Slim\Routing\RouteCollectorProxy;


return function( \Slim\App $app):\Slim\App {

    $app->options('/{routes:.+}', function(Request $rq, Response $rs, array $args): Response {
        return $rs
        ->withHeader('Access-Control-Allow-Origin', $rq->getHeaderLine('Origin'))
        ->withHeader('Access-Control-Allow-Methods', 'POST, PUT, GET, DELETE, OPTIONS')
        ->withHeader('Access-Control-Allow-Headers', 'Authorization, Content-Type')
        ->withHeader('Access-Control-Max-Age', 3600)
        ->withHeader('Access-Control-Allow-Credentials', 'true');
    });

    $app->get('/', HomeAction::class);

    $app->get('/films', GetFilmsAction::class);
    return $app;
};





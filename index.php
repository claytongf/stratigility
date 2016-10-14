<?php
require __DIR__.'/vendor/autoload.php';

$app = new Zend\Stratigility\MiddlewarePipe();

$server = Zend\Diactoros\Server::createServer($app, $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

$app->pipe('/', function($request, $response, $next){
    if(!in_array($request->getUri()->getPath(),['/',''],true)){
        echo get_class($next);
        return $next($request,$response);
    }
    return $response->write("Mostrando minha página principal");
});
$app->pipe('/rota1', function($request, $response, $next){
    return $response->write("rota1");
});
$app->pipe('/rota2', function($request, $response, $next){
    return $response->write("rota2");
});
$app->pipe('/rota3', function($request, $response, $next){
    return $response->write("rota3");
});
$server->listen();
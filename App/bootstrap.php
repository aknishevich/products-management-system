<?php

require 'vendor/autoload.php';

use \App\Repository\ProductRepository;
use App\Db\DataBase;
use \App\Controllers\AddProductController;
use \App\Controllers\EditProductsController;
use \App\Controllers\AttributesController;
use \App\Controllers\MainController;
use \App\Controllers\ProductController;

/**
 * Defines existing paths and include the necessary controllers.
 */
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/addProduct', new AddProductController);
    $r->addRoute('POST', '/addProduct', new AddProductController);
    $r->addRoute('GET', '/editProducts', new EditProductsController);
    $r->addRoute('POST', '/editProducts', new EditProductsController);
    $r->addRoute('GET', '/product', new ProductController());
    $r->addRoute('GET', '/attributes', new AttributesController());
    $r->addRoute('GET', '/', new MainController);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);


switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Method Not Allowed
        $main = new MainController;
        $main->__invoke();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        $handler->__invoke();
        break;
}

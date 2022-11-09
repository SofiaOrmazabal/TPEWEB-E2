<?php
require_once './libs/Router.php';
require_once './app/controllers/product-api.controller.php';

$router = new Router();

$router->addRoute('product', 'GET', 'ProductApiController', 'getProducts');
$router->addRoute('product/:ID', 'GET', 'ProductApiController', 'getProduct');
$router->addRoute('product/:ID', 'DELETE', 'ProductApiController', 'deleteProduct');
$router->addRoute('product', 'POST', 'ProductApiController', 'insertProduct'); 




$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
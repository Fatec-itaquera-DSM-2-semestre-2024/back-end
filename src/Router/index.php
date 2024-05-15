<?php
namespace App\Router;
require "../../vendor/autoload.php";

use Bramus\Router\Router;

$router = new Router();

require __DIR__ . '/Usuarios.php';
require __DIR__ . '/Token.php';

header('Content-Type: application/json');

// In case one is using PHP 5.4's built-in server
$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if ( php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, route not found!';
});


$router->set404('/test(/.*)?', function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '<h1><mark>404, route not found!</mark></h1>';
});

$router->set404('/api(/.*)?', function() {
    header('HTTP/1.1 404 Not Found');
    header('Content-Type: application/json');
    $jsonArray = array();
    $jsonArray['status'] = "404";
    $jsonArray['status_text'] = "route not defined";
    echo json_encode($jsonArray);
});

$router->before('GET', '/.*', function () {
    header('X-Powered-By: bramus/router');
});

addTokenRoutes($router);    
addUsuarioRoutes($router);

$router->run();

// EOF

<?php
// Simples roteamento baseado na URL
$request = $_SERVER['REQUEST_URI'];
require __DIR__ . '/vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\ReservationController;

switch ($request) {
    case '/' :
        require __DIR__ . '\views\auth\register.php';
        break;
    case '/auth/login' :
        $controller = new AuthController();
        $controller->login();
        break;
    case '/auth/register' :
        $controller = new AuthController();
        $controller->register();
        break;
    case '/reservations' :
        $controller = new ReservationController();
        $controller->index();
        break;
    case '/reservations/create' :
        $controller = new ReservationController();
        $controller->create();
        break;
    case (preg_match('/reservations\/edit\/(\d+)/', $request, $matches) ? true : false) :
        $controller = new ReservationController();
        $controller->edit($matches[1]);
        break;
    case (preg_match('/reservations\/delete\/(\d+)/', $request, $matches) ? true : false) :
        $controller = new ReservationController();
        $controller->delete($matches[1]);
        break;
    default:
        http_response_code(404);
        echo "Página não encontrada";
        break;
}
?>

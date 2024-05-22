<?php
namespace App\Router;

use App\Controller\ReservaController;

function addReservaRoutes($router) {
    $router->mount('/Reservas', function () use ($router) {
        $router->get('/', function () {
            $reserva = new ReservaController();
            echo json_encode($reserva->selectAll());
        });

        $router->get('/{id}', function ($id) {
            $reserva = new ReservaController();
            echo json_encode($reserva->selectById($id));
        });
        
        $router->post('/cadastrar', function () {
            $reserva = new ReservaController();
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($reserva->cadastrar($data['id_reserva'], $data['destinatario_reserva'], $data['observacao'], $data['data_reserva'], $data['horario_inicio'], $data['horario_fim'], $data['confirma'], $data['id_sala'], $data['id_usuario']));
        });
        
        $router->put('/{id}', function ($id) {
            $reserva = new ReservaController();
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($reserva->atualizar($id, $data['destinatario_reserva'], $data['observacao'], $data['data_reserva'], $data['horario_inicio'], $data['horario_fim'], $data['confirma'], $data['id_sala'], $data['id_usuario']));           
        });

        $router->delete('/{id}', function ($id) {
            $reserva = new ReservaController();
            echo json_encode($reserva->excluir($id));
 
        });
    });
}


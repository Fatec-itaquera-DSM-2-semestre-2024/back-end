<?php

namespace App\Router;

use App\Controller\ReservaController;
use Exception;

function addReservaRoutes($router)
{
    $router->mount('/Reservas', function () use ($router) {
        $router->get('/', function () {
            try {
                $reserva = new ReservaController();
                if ($reservas = $reserva->selectAll()) {
                    echo json_encode($reservas);
                } else {
                    echo json_encode(['error' => 'Nenhuma reserva encontrada']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->get('/{id}', function ($id) {
            try {
                $reserva = new ReservaController();
                if ($reserva = $reserva->selectById($id)) {
                    echo json_encode($reserva);
                } else {
                    echo json_encode(['error' => 'Reserva não encontrada']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->post('/cadastrar', function () {
            try {
                $reservaController = new ReservaController();
                $data = json_decode(file_get_contents('php://input'), true);
                $result = $reservaController->cadastrar(
                    $data['destinatario_reserva'],
                    $data['observacao'],
                    $data['horario_inicio'],
                    $data['horario_fim'],
                    $data['nome_sala']
                );
                if (isset($result['success'])) {
                    echo json_encode($result);
                } else {
                    echo json_encode(['error' => 'Erro ao cadastrar reserva', $result]);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->put('/{id}', function ($id) {
            try {
                $reserva = new ReservaController();
                $data = json_decode(file_get_contents('php://input'), true);
                if ($reserva->atualizar(
                    $id,
                    $data['destinatario_reserva'],
                    $data['observacao'],
                    $data['horario_inicio'],
                    $data['horario_fim'],
                    $data['status'],
                    $data['nome_sala'],
                    
                )) {
                    echo json_encode(['success' => 'Reserva atualizada com sucesso']);
                } else {
                    echo json_encode(['error' => 'Erro ao atualizar reserva']);
                }
                
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->delete('/{id}', function ($id) {
            try {
                $reserva = new ReservaController();
                if ($reserva->excluir($id)) {
                    echo json_encode(['success' => 'Reserva excluída com sucesso']);
                } else {
                    echo json_encode(['error' => 'Erro ao excluir reserva']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });
    });
}
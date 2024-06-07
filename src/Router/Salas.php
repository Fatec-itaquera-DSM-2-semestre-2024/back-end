<?php

namespace App\Router;

use App\Controller\SalaController;
use Exception;

function addSalaRoutes($router)
{
    $router->mount('/Sala', function () use ($router) {
        $router->get('/', function () {
            try {
                $sala = new SalaController();
                if ($salas = $sala->selectAll()) {
                    echo json_encode($salas);
                } else {
                    echo json_encode(['error' => 'Nenhuma sala encontrada']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->get('/{id}', function ($id) {
            try {
                $sala = new SalaController();
                if ($sala = $sala->selectById($id)) {
                    echo json_encode($sala);
                } else {
                    echo json_encode(['error' => 'Reserva não encontrada']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->post('/cadastrar', function () {
            try {
                $sala = new SalaController();
                $data = json_decode(file_get_contents('php://input'), true);
                if ($sala->cadastrar($data['id_sala'], $data['numero_sala'], $data['capacidade_sala'], $data['id_equipamento'])) {
                    echo json_encode(['success' => 'Sala cadastrada com sucesso']);
                } else {
                    echo json_encode(['error' => 'Erro ao cadastrar sala']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->put('/{id}', function ($id) {
            try {
                $sala = new SalaController();
                $data = json_decode(file_get_contents('php://input'), true);
                if ($sala->atualizar($id, $data['numero_sala'], $data['capacidade_sala'], $data['id_equipamento'])) {
                    echo json_encode(['success' => 'Sala atualizada com sucesso']);
                } else {
                    echo json_encode(['error' => 'Erro ao atualizar sala']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->delete('/{id}', function ($id) {
            try {
                $sala = new SalaController();
                if ($sala->excluir($id)) {
                    echo json_encode(['success' => 'Sala excluída com sucesso']);
                } else {
                    echo json_encode(['error' => 'Erro ao excluir sala']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });
    });
}

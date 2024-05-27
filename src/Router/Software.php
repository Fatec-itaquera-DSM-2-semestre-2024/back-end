<?php

namespace App\Router;

use App\Controller\ReservaController; // Mantendo a referência correta ao controlador
use Exception;

function addSoftwareRoutes($router)
{
    $router->mount('/software', function () use ($router) {
        $router->get('/', function () {
            try {
                $softwareController = new ReservaController(); // Utilizando o controlador correto
                $softwares = $softwareController->selectAll();
                if ($softwares) {
                    echo json_encode(['data' => $softwares]);
                } else {
                    echo json_encode(['error' => 'Nenhum software encontrado']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->get('/{id}', function ($id) {
            try {
                $softwareController = new ReservaController(); // Utilizando o controlador correto
                $software = $softwareController->selectById($id);
                if ($software) {
                    echo json_encode(['data' => $software]);
                } else {
                    echo json_encode(['error' => 'Software não encontrado']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->post('/cadastrar', function () {
            try {
                $softwareController = new ReservaController(); // Utilizando o controlador correto
                $data = json_decode(file_get_contents('php://input'), true);
                if ($softwareController->cadastrar(
                    $data['id_software'], 
                    $data['nome_software'], 
                    $data['versao_software'], 
                    $data['descricao_software'], 
                    $data['preco_software']
                )) {
                    echo json_encode(['success' => 'Software cadastrado com sucesso']);
                } else {
                    echo json_encode(['error' => 'Erro ao cadastrar software']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->put('/{id}', function ($id) {
            try {
                $softwareController = new ReservaController(); // Utilizando o controlador correto
                $data = json_decode(file_get_contents('php://input'), true);
                if ($softwareController->atualizar(
                    $id,
                    $data['nome_software'], 
                    $data['versao_software'], 
                    $data['descricao_software'], 
                    $data['preco_software']
                )) {
                    echo json_encode(['success' => 'Software atualizado com sucesso']);
                } else {
                    echo json_encode(['error' => 'Erro ao atualizar software']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        $router->delete('/{id}', function ($id) {
            try {
                $softwareController = new ReservaController(); // Utilizando o controlador correto
                if ($softwareController->excluir($id)) {
                    echo json_encode(['success' => 'Software excluído com sucesso']);
                } else {
                    echo json_encode(['error' => 'Erro ao excluir software']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        });
    });
}

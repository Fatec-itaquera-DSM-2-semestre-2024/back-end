<?php

namespace App\Router;

use App\Controller\SoftwareController; // Certifique-se de usar o controlador correto
use Exception;

/**
 * Adiciona as rotas para gerenciamento de software.
 * 
 * @param object $router O objeto router utilizado para definir as rotas.
 */
function addSoftwareRoutes($router)
{
    // Monta as rotas no caminho base /software
    $router->mount('/software', function () use ($router) {
        
        // Define a rota GET para listar todos os softwares
        $router->get('/', function () {
            try {
                $softwareController = new SoftwareController(); // Instancia o controlador correto
                $softwares = $softwareController->selectAll(); // Chama o método para selecionar todos os softwares
                if ($softwares) {
                    echo json_encode(['data' => $softwares]); // Retorna os dados dos softwares
                } else {
                    echo json_encode(['error' => 'Nenhum software encontrado']); // Retorna mensagem de erro se não houver softwares
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]); // Captura e retorna qualquer exceção lançada
            }
        });

        // Define a rota GET para obter um software específico pelo ID
        $router->get('/{id}', function ($id) {
            try {
                $softwareController = new SoftwareController(); // Instancia o controlador correto
                $software = $softwareController->selectById($id); // Chama o método para selecionar o software pelo ID
                if ($software) {
                    echo json_encode(['data' => $software]); // Retorna os dados do software
                } else {
                    echo json_encode(['error' => 'Software não encontrado']); // Retorna mensagem de erro se o software não for encontrado
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]); // Captura e retorna qualquer exceção lançada
            }
        });

        // Define a rota POST para cadastrar um novo software
        $router->post('/cadastrar', function () {
            try {
                $softwareController = new SoftwareController(); // Instancia o controlador correto
                $data = json_decode(file_get_contents('php://input'), true); // Obtém os dados do corpo da requisição
                if ($softwareController->cadastrar(
                    $data['id_software'], 
                    $data['nome_software'], 
                    $data['versao_software'], 
                    $data['descricao_software'], 
                    $data['preco_software']
                )) {
                    echo json_encode(['success' => 'Software cadastrado com sucesso']); // Retorna mensagem de sucesso
                } else {
                    echo json_encode(['error' => 'Erro ao cadastrar software']); // Retorna mensagem de erro se o cadastro falhar
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]); // Captura e retorna qualquer exceção lançada
            }
        });

        // Define a rota PUT para atualizar um software existente pelo ID
        $router->put('/{id}', function ($id) {
            try {
                $softwareController = new SoftwareController(); // Instancia o controlador correto
                $data = json_decode(file_get_contents('php://input'), true); // Obtém os dados do corpo da requisição
                if ($softwareController->atualizar(
                    $id,
                    $data['nome_software'], 
                    $data['versao_software'], 
                    $data['descricao_software'], 
                    $data['preco_software']
                )) {
                    echo json_encode(['success' => 'Software atualizado com sucesso']); // Retorna mensagem de sucesso
                } else {
                    echo json_encode(['error' => 'Erro ao atualizar software']); // Retorna mensagem de erro se a atualização falhar
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]); // Captura e retorna qualquer exceção lançada
            }
        });

        // Define a rota DELETE para excluir um software pelo ID
        $router->delete('/{id}', function ($id) {
            try {
                $softwareController = new SoftwareController(); // Instancia o controlador correto
                if ($softwareController->excluir($id)) {
                    echo json_encode(['success' => 'Software excluído com sucesso']); // Retorna mensagem de sucesso
                } else {
                    echo json_encode(['error' => 'Erro ao excluir software']); // Retorna mensagem de erro se a exclusão falhar
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]); // Captura e retorna qualquer exceção lançada
            }
        });
    });
}

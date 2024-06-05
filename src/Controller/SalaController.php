<?php

namespace App\Controller;

use App\Database\Crud;
use PDOException;

class SalaController {
    private $crud;

    public function __construct() {
        $this->crud = new Crud();
    }

    public function listarSalas() {
        try {
            $salas = $this->crud->select('salas');
            return $salas;
        } catch (PDOException $e) {
            return ['error' => 'Erro ao listar as salas: ' . $e->getMessage()];
        }
    }

    public function adicionarSala($dados) {
        try {
            $resultado = $this->crud->insert('salas', $dados);
            if ($resultado) {
                return ['success' => 'Sala adicionada com sucesso.'];
            } else {
                return ['error' => 'Erro ao adicionar a sala.'];
            }
        } catch (PDOException $e) {
            return ['error' => 'Erro ao adicionar a sala: ' . $e->getMessage()];
        }
    }

    public function atualizarSala($id, $novosDados) {
        try {
            $resultado = $this->crud->update('salas', $novosDados, ['id' => $id]);
            if ($resultado) {
                return ['success' => 'Sala atualizada com sucesso.'];
            } else {
                return ['error' => 'Erro ao atualizar a sala.'];
            }
        } catch (PDOException $e) {
            return ['error' => 'Erro ao atualizar a sala: ' . $e->getMessage()];
        }
    }

    public function excluirSala($id) {
        try {
            $resultado = $this->crud->delete('salas', ['id' => $id]);
            if ($resultado) {
                return ['success' => 'Sala excluída com sucesso.'];
            } else {
                return ['error' => 'Erro ao excluir a sala.'];
            }
        } catch (PDOException $e) {
            return ['error' => 'Erro ao excluir a sala: ' . $e->getMessage()];
        }
    }
}

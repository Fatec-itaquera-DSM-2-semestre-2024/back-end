<?php

namespace App\Model;

use App\Database\Connection;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Sala
{
    private $secretKey = 'sua_chave_secreta'; // Mesma chave secreta usada para gerar o token

    private function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded->data; // Retorna os dados do usuário do token
        } catch (Exception $e) {
            throw new Exception('Token inválido ou expirado');
        }
    }

    function selectAll($token)
    {
        try {
            $this->validateToken($token);
            $db = new Connection();
            $sql = 'SELECT * FROM sala';
            return $db->query($sql);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function selectById($id, $token)
    {
        try {
            $this->validateToken($token);
            $db = new Connection();
            $sql = 'SELECT * FROM sala WHERE id_sala = :id';
            return $db->query($sql, ['id' => $id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function cadastrar($id_sala, $numero_sala, $capacidade_sala, $id_equipamento, $token)
    {
        try {
            $this->validateToken($token);
            $db = new Connection();
            $sql = 'INSERT INTO sala (
                id_sala, numero_sala, capacidade_sala, id_equipamento
            ) VALUES (
                :id_sala, :numero_sala, :capacidade_sala, :id_equipamento
            )';
            return $db->query_insert($sql, [
                'id_sala' => $id_sala,
                'numero_sala' => $numero_sala,
                'capacidade_sala' => $capacidade_sala,
                'id_equipamento' => $id_equipamento
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function atualizar($id, $numero_sala, $capacidade_sala, $id_equipamento, $token)
{
    try {
        $this->validateToken($token);
        $db = new Connection();
        $sql = 'UPDATE sala SET 
            numero_sala = :numero_sala, 
            capacidade_sala = :capacidade_sala,
            id_equipamento = :id_equipamento
            WHERE id_sala = :id_sala';
        return $db->query_update($sql, [
            'id_sala' => $id, 
            'numero_sala' => $numero_sala,
            'capacidade_sala' => $capacidade_sala,
            'id_equipamento' => $id_equipamento
        ]);
    } catch (Exception $e) {
        return $e->getMessage();
    }
}


    function excluir($id, $token)
    {
        try {
            $this->validateToken($token);
            $db = new Connection();
            $sql = 'DELETE FROM sala WHERE id_sala = :id';
            return $db->query_delete($sql, ['id' => $id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}